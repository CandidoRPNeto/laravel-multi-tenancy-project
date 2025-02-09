<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SetAIModelInSession
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
        $ai_model = $event->user->ai_model;
        $model = [
            'provider'=> $ai_model->provider,
            'token'=> $ai_model->token,
            'model'=> $ai_model->model
        ];
        session()->put('model', $model);
    }
}
