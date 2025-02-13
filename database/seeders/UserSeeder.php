<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\AIModel;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'adm@mail.com',
            'password' => bcrypt('password'),
            'role_id' => RoleEnum::ADMIN,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);
        AIModel::create([
            'user_id' => $user->id,
            'provider' => 1,
            'token' => 'random',
        ]);
    }
}
