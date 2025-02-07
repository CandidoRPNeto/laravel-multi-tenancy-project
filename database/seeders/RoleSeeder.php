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
            ['id' => 1,'name' => 'Admin', 'updated_at' => now(), 'created_at' => now()],
            ['id' => 2,'name' => 'Manager', 'updated_at' => now(), 'created_at' => now()],
            ['id' => 3,'name' => 'Seller', 'updated_at' => now(), 'created_at' => now()],
            ['id' => 4,'name' => 'Client', 'updated_at' => now(), 'created_at' => now()],
        ];
        Role::insert($roles);
    }
}
