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

        // Remove usuário admin de exemplo antigo caso exista
        if ($adminEmail !== 'admin@admin.com') {
            User::where('email', 'admin@admin.com')->delete();
        }
    }
}
