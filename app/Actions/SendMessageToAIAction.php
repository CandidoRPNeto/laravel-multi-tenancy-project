<?php
namespace App\Actions;


class SendMessageToAIAction {

    public static function execute($prompt){
        //TODO: put in AUTH ai_id
        $id =  '';
        $chat = SelectLLMAction::execute($id);
        return $chat->sendMessage($prompt);
    }

}