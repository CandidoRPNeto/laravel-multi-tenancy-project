<?php

namespace App\Policies;

use App\Enums\RoleEnum;
use App\Models\Client;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ClientPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Client $client): bool
    {
        return $this->getDefaultAuthorize($user->role_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $this->getDefaultAuthorize($user->role_id);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Client $client): bool
    {
        return $this->getDefaultAuthorize($user->role_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Client $client): bool
    {
        return $this->getDefaultAuthorize($user->role_id);
    }


    public function getDefaultAuthorize($role): bool
    {
        return $role === RoleEnum::MANAGER;
    }
}
