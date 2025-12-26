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

        //  User::factory()->create([
        //     'name' => 'Khafid',
        //     'email' => 'khafid@gmail.com',
        //     'role' => 'owner',
        //     'password' => bcrypt('password'),
        // ]);

        // User::factory()->create([
        //     'name' => 'Alfian',
        //     'email' => 'alfian@gmail.com',
        //     'role' => 'admin',
        //     'password' => bcrypt('password'),
        // ]);

        $this->call(PemasukanSeeder::class);
        // $this->call(PengeluaranSeeder::class);
    }
}
