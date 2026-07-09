<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\FirebaseService;

class ProjectController extends Controller
{
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        $this->firebaseService = $firebaseService;
    }

    public function index()
    {
        $projects = $this->firebaseService->getAllProjects();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        return view('admin.projects.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // Max 5MB
        ]);

        // Upload da imagem para storage/app/public/projects
        $imagePath = $request->file('image')->store('projects', 'public');
        $imageUrl = asset('storage/' . $imagePath);

        // Preparar dados para o Firebase
        $firebaseData = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'image_url' => $imageUrl,
        ];

        $this->firebaseService->createProject($firebaseData);

        return redirect()->route('admin.projects.index')->with('success', 'Produto cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $project = $this->firebaseService->getProjectById($id);
        
        if (!$project) {
            return redirect()->route('admin.projects.index')->with('error', 'Produto não encontrado.');
        }

        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $project = $this->firebaseService->getProjectById($id);
        
        if (!$project) {
            return redirect()->route('admin.projects.index')->with('error', 'Produto não encontrado.');
        }

        $firebaseData = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'price' => $validated['price'],
        ];

        // Se uma nova imagem foi enviada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $firebaseData['image_url'] = asset('storage/' . $imagePath);
        } else {
            // Mantém a imagem atual
            $firebaseData['image_url'] = $project['image_url'] ?? null;
        }

        $this->firebaseService->updateProject($id, $firebaseData);

        return redirect()->route('admin.projects.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->firebaseService->deleteProject($id);
        return redirect()->route('admin.projects.index')->with('success', 'Projeto removido!');
    }
}
