<?php

namespace Tests;

use App\Enums\RoleEnum;
use App\Models\Company;
use App\Models\Seller;
use App\Models\User;

class TestHelper
{
    public static function makeUser(array $params = []): User
    {
        return User::factory()
            ->has(Seller::factory()->state(['company_id' => Company::first()->id]))
            ->create(array_merge([ 'role_id' => RoleEnum::SELLER],$params));
    }
}
