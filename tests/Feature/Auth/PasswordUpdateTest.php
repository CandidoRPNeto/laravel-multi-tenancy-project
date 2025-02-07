<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function Pest\Laravel\seed;
use Database\Seeders\CompanySeeder;
use Database\Seeders\RoleSeeder;
use Tests\TestHelper;

beforeEach(function(){
    seed(RoleSeeder::class);
    seed(CompanySeeder::class);
});


test('password can be updated', function () {
    $user = TestHelper::makeUser();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password' => 'password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertTrue(Hash::check('new-password', $user->refresh()->password));
});

test('correct password must be provided to update password', function () {
    $user = TestHelper::makeUser();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->put('/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('updatePassword', 'current_password')
        ->assertRedirect('/profile');
});
