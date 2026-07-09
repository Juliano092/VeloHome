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
            'description' => 'required|string',
            'image_url' => 'required|url',
            'model_url' => 'required|url',
        ]);

        $this->firebaseService->createProject($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Projeto cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        $this->firebaseService->deleteProject($id);
        return redirect()->route('admin.projects.index')->with('success', 'Projeto removido!');
    }
}
