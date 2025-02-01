<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Admin', 'updated_at' => now(), 'created_at' => now()],
            ['name' => 'Manager', 'updated_at' => now(), 'created_at' => now()],
            ['name' => 'Seller', 'updated_at' => now(), 'created_at' => now()],
            ['name' => 'Client', 'updated_at' => now(), 'created_at' => now()],
        ];
        Role::insert($roles);
    }
}
