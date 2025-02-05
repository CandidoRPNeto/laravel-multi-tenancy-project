<?php
namespace App\Actions;

use Illuminate\Container\Attributes\Auth;

class SendMessageToAIAction {

    public static function execute($prompt){
        $chat = SelectLLMAction::execute();
        return $chat->sendMessage($prompt);
    }

}