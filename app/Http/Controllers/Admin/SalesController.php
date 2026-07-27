<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $firebaseService;

    public function __construct(\App\Services\FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        $sales = $this->firebaseService->getAllSales();
        $projects = $this->firebaseService->getAllProjects();
        return view('admin.sales.index', compact('sales', 'projects'));
    }

    public function calculator()
    {
        return view('admin.sales.calculator');
    }

    public function reports()
    {
        $sales = $this->firebaseService->getAllSales();
        $projects = $this->firebaseService->getAllProjects();

        // Agregar estatísticas por peça/produto
        $productStats = [];
        foreach ($sales as $sale) {
            $name = $sale['product_name'] ?? 'Outros';
            $paid = floatval($sale['amount_paid'] ?? 0);
            $date = isset($sale['sale_date']) ? $sale['sale_date'] : ($sale['created_at'] ?? time());

            if (!isset($productStats[$name])) {
                $productStats[$name] = [
                    'title' => $name,
                    'total_qty' => 0,
                    'total_revenue' => 0,
                    'sales' => []
                ];
            }

            $productStats[$name]['total_qty'] += 1;
            $productStats[$name]['total_revenue'] += $paid;
            $productStats[$name]['sales'][] = [
                'client' => $sale['client_name'] ?? 'Cliente',
                'amount' => $paid,
                'date' => $date
            ];
        }

        // Ordenar produtos pelo total vendido
        usort($productStats, function($a, $b) {
            return $b['total_qty'] <=> $a['total_qty'];
        });

        return view('admin.sales.reports', compact('productStats', 'sales', 'projects'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'product_name' => 'required|string|max:255',
            'amount_paid' => 'required|numeric',
            'sale_date' => 'nullable|date',
        ]);

        $saleDate = !empty($validated['sale_date']) ? strtotime($validated['sale_date']) : time();

        $this->firebaseService->createSale([
            'client_name' => $validated['client_name'],
            'contact' => $validated['contact'],
            'product_name' => $validated['product_name'],
            'amount_paid' => $validated['amount_paid'],
            'sale_date' => $saleDate,
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Venda registrada com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'product_name' => 'required|string|max:255',
            'amount_paid' => 'required|numeric',
            'sale_date' => 'nullable|date',
        ]);

        $saleData = [
            'client_name' => $validated['client_name'],
            'contact' => $validated['contact'],
            'product_name' => $validated['product_name'],
            'amount_paid' => $validated['amount_paid'],
        ];

        if (!empty($validated['sale_date'])) {
            $saleData['sale_date'] = strtotime($validated['sale_date']);
        }

        $this->firebaseService->updateSale($id, $saleData);

        return redirect()->route('admin.sales.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->firebaseService->deleteSale($id);
        return redirect()->route('admin.sales.index')->with('success', 'Registro de venda removido!');
    }
}
