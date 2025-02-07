<?php

use App\Providers\RouteServiceProvider;
use Database\Seeders\RoleSeeder;

use function Pest\Laravel\seed;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    seed(RoleSeeder::class);
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'company_name' => 'Company Test',
        'provider'=> 1,
        'token'=> "SAFFSJFJSJ20j2mweçdsa24eq1233qwrasf234ewsda",
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(RouteServiceProvider::HOME);
});
