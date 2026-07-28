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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $imagesUrls = [];

        // Upload capa principal (se informada)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $imagesUrls[] = asset('storage/' . $imagePath);
        }

        // Upload de múltiplas imagens
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                $imagesUrls[] = asset('storage/' . $path);
            }
        }

        $firebaseData = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'image_url' => $imagesUrls[0] ?? null,
            'images' => array_values(array_unique($imagesUrls)),
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
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        $project = $this->firebaseService->getProjectById($id);
        
        if (!$project) {
            return redirect()->route('admin.projects.index')->with('error', 'Produto não encontrado.');
        }

        $existingImages = $project['images'] ?? ($project['image_url'] ? [$project['image_url']] : []);

        $newImages = [];
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('projects', 'public');
            $newImages[] = asset('storage/' . $imagePath);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('projects', 'public');
                $newImages[] = asset('storage/' . $path);
            }
        }

        if (!empty($newImages)) {
            $imagesUrls = array_values(array_unique(array_merge($newImages, $existingImages)));
        } else {
            $imagesUrls = $existingImages;
        }

        $firebaseData = [
            'title' => $validated['title'],
            'category' => $validated['category'],
            'price' => $validated['price'],
            'image_url' => $imagesUrls[0] ?? null,
            'images' => $imagesUrls,
        ];

        $this->firebaseService->updateProject($id, $firebaseData);

        return redirect()->route('admin.projects.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $this->firebaseService->deleteProject($id);
        return redirect()->route('admin.projects.index')->with('success', 'Projeto removido!');
    }
}
