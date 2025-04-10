<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();

        // Создаем роли
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
    }
}
