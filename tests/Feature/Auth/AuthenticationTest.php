<?php

use App\Enums\RoleEnum;
use App\Models\Address;
use App\Models\Client;
use App\Models\Company;
use App\Models\Seller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\AddressSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\RoleSeeder;

use function Pest\Laravel\seed;

beforeEach(function(){
    seed(RoleSeeder::class);
    seed(CompanySeeder::class);
});

test('login screen can be rendered', function () {
    $response = $this->get('/login');
    $response->assertStatus(200);
});

test('sellers users can authenticate using the login screen', function () {
    $user = User::factory()
    ->has(Seller::factory()->state(['company_id' => Company::first()->id]))
    ->create(['role_id' => RoleEnum::SELLER]);
    successCase($this, $user->email);
});

test('sellers users can not authenticate using the login screen', function () {
    $user = User::factory()
    ->has(Seller::factory()->state(['company_id' => Company::first()->id]))
    ->create(['role_id' => RoleEnum::SELLER]);
    failCase($this, $user->email);
});


test('clients users can authenticate using the login screen', function () {
    seed(AddressSeeder::class);
    $user = User::factory()
    ->has(Client::factory()->state(['address_id'=>Address::first()->id,'company_id' => Company::first()->id]))
    ->create(['role_id' => RoleEnum::CLIENT]);
    successCase($this, $user->email);
});

test('clients users can not authenticate using the login screen', function () {
    seed(AddressSeeder::class);
    $user = User::factory()
    ->has(Client::factory()->state(['address_id'=>Address::first()->id,'company_id' => Company::first()->id]))
    ->create(['role_id' => RoleEnum::CLIENT]);
    failCase($this, $user->email);
});

test('admin users can authenticate using the login screen', function () {
    $user = User::factory()
    ->create(['role_id' => RoleEnum::ADMIN]);
    successCase($this, $user->email);
});

test('admin users can not authenticate using the login screen', function () {
    $user = User::factory()
    ->create(['role_id' => RoleEnum::ADMIN]);
    failCase($this, $user->email);
});

function failCase($test,string $email){
    $test->post('/login', [
        'email' => $email,
        'password' => 'wrong-password',
    ]);
    $test->assertGuest();
}

function successCase($test,string $email){
    $response = $test->post('/login', [
        'email' => $email,
        'password' => 'password',
    ]);
    $test->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
}