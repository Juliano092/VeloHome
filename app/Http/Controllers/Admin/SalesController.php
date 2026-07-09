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
        return view('admin.sales.index', compact('sales'));
    }

    public function calculator()
    {
        return view('admin.sales.calculator');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'product_name' => 'required|string|max:255',
            'amount_paid' => 'required|numeric',
        ]);

        $this->firebaseService->createSale([
            'client_name' => $validated['client_name'],
            'contact' => $validated['contact'],
            'product_name' => $validated['product_name'],
            'amount_paid' => $validated['amount_paid'],
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
        ]);

        $this->firebaseService->updateSale($id, [
            'client_name' => $validated['client_name'],
            'contact' => $validated['contact'],
            'product_name' => $validated['product_name'],
            'amount_paid' => $validated['amount_paid'],
        ]);

        return redirect()->route('admin.sales.index')->with('success', 'Venda atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $this->firebaseService->deleteSale($id);
        return redirect()->route('admin.sales.index')->with('success', 'Registro de venda removido!');
    }
}
