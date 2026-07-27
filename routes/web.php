<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Route;

Route::get('/', function (FirebaseService $firebaseService) {
    $projects = $firebaseService->getAllProjects();
    return view('welcome', compact('projects'));
});

Route::get('/dashboard', function (FirebaseService $firebaseService) {
    $projects = $firebaseService->getAllProjects();
    $sales = $firebaseService->getAllSales();

    $totalProducts = count($projects);
    $totalSalesAmount = array_sum(array_column($sales, 'amount_paid'));
    $totalSalesCount = count($sales);
    $recentSales = array_slice($sales, 0, 5);
    $recentProjects = array_slice($projects, 0, 4);

    return view('dashboard', compact('totalProducts', 'totalSalesAmount', 'totalSalesCount', 'recentSales', 'recentProjects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Projects / Portfolio
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('projects.update');
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');

    // Sales
    Route::get('/sales', [\App\Http\Controllers\Admin\SalesController::class, 'index'])->name('sales.index');
    Route::get('/reports', [\App\Http\Controllers\Admin\SalesController::class, 'reports'])->name('reports');
    Route::get('/calculator', [\App\Http\Controllers\Admin\SalesController::class, 'calculator'])->name('calculator');
    Route::post('/sales', [\App\Http\Controllers\Admin\SalesController::class, 'store'])->name('sales.store');
    Route::put('/sales/{id}', [\App\Http\Controllers\Admin\SalesController::class, 'update'])->name('sales.update');
    Route::delete('/sales/{id}', [\App\Http\Controllers\Admin\SalesController::class, 'destroy'])->name('sales.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
