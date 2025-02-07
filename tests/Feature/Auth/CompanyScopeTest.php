<?php
use function Pest\Laravel\seed;

use App\Enums\RoleEnum;
use App\Models\Client;
use App\Models\Company;
use App\Models\Seller;
use App\Models\User;
use Database\Seeders\AddressSeeder;
use Database\Seeders\CompanySeeder;
use Database\Seeders\RoleSeeder;
use Illuminate\Support\Facades\Auth;

beforeEach(function(){
    seed(AddressSeeder::class);
    seed(RoleSeeder::class);
    seed(CompanySeeder::class);
});

test('seller user can only see clients on his tenant', function () {
    $company1 = Company::factory()->create();
    $company2 = Company::factory()->create();
    $user1 = User::factory()
        ->has(Seller::factory()->state(['company_id' => $company1->id]))
        ->create([ 'role_id' => RoleEnum::SELLER]);
    Client::factory()->count(10)->create(['company_id' => $company1->id]);
    Client::factory()->count(10)->create(['company_id' => $company2->id]);
    $this->assertSame(20,Client::count());
    Auth::loginUsingId($user1->id);
    $this->assertSame(10,Client::count());
});

test('seller user can only see seller on his tenant', function () {
    $company1 = Company::factory()->create();
    $company2 = Company::factory()->create();
    $user1 = User::factory()
        ->has(Seller::factory()->state(['company_id' => $company1->id]))
        ->create([ 'role_id' => RoleEnum::SELLER]);
    Seller::factory()->count(10)->create(['company_id' => $company1->id]);
    Seller::factory()->count(10)->create(['company_id' => $company2->id]);
    $this->assertSame(21,Seller::count());
    Auth::loginUsingId($user1->id);
    $this->assertSame(11,Seller::count());
});
