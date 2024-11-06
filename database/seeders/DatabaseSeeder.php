<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creating Admin User
        User::factory()->withPersonalTeam()->create([
            'name' => 'Admin User',
            'email' => 'admin@mail.com',
            'role' => 'admin',
            'password' => Hash::make('12345678'),
        ]);

        // Creating Regular User
        User::factory()->withPersonalTeam()->create([
            'name' => 'User',
            'email' => 'user@mail.com',
            'role' => 'user',
            'password' => Hash::make('12345678'),
        ]);

        $this->call([
            WardSeeder::class,
            GenericSeeder::class,
            MedicineSeeder::class,
        ]);
    }
}
