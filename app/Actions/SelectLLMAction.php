<?php
namespace App\Actions;

use App\Services\LLMs\Gemini;
use App\Services\LLMs\LLMApiInterface;
use App\Services\LLMs\OpenAIChats;

class SelectLLMAction {

    public static function execute($id):  LLMApiInterface{
        //TODO: get AI object using $id
        $ai_service = 'gemini';
        switch ($ai_service) {
            case 'gemini':
                return new Gemini( "AIzaSyASplF9xWJvbf6bqkv_EA6gHG5US33nqpA", '');
                break;
            default:
                return new OpenAIChats('','gpt-3.5-turbo-instruct');
                break;
        }
    }

}