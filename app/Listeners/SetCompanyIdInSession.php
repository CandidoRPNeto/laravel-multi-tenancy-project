<?php

namespace App\Listeners;

use App\Enums\RoleEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetCompanyIdInSession
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $role_id = $event->user->role_id;
        if($role_id == RoleEnum::MANAGER || $role_id == RoleEnum::SELLER)
            session()->put('company_id', $event->user->seller->company_id);
        else if($role_id == RoleEnum::CLIENT)
            session()->put('company_id', $event->user->client->company_id);
    }
}
