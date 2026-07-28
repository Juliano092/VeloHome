<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $adminEmail = env('ADMIN_EMAIL', 'julianocardoso2611@gmail.com');
        $adminPassword = env('ADMIN_PASSWORD', 'ValoHome3D#2026!');

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'ValoHome Admin',
                'password' => \Illuminate\Support\Facades\Hash::make($adminPassword),
            ]
        );

        // Seed inicial de produtos se o catálogo estiver vazio
        $firebaseService = app(\App\Services\FirebaseService::class);
        if (count($firebaseService->getAllProjects()) === 0) {
            $firebaseService->createProject([
                'title' => 'Suporte de relógio',
                'category' => 'Acessório para relógio',
                'price' => 26.90,
                'image_url' => '/imagem/valohome_logo.png',
                'images' => ['/imagem/valohome_logo.png'],
                'description' => 'Peça impressa em alta resolução 3D com acabamento artesanal ValoHome.',
            ]);
        }
    }
}
