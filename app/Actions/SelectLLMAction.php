<?php
namespace App\Actions;

use App\Enums\ProviderEnum;
use App\Services\LLMs\Gemini;
use App\Services\LLMs\LLMApiInterface;
use App\Services\LLMs\OpenAIChats;
use Exception;

class SelectLLMAction {

    public static function execute():  LLMApiInterface{
        $model = session()->get('model');
        switch ($model['provider']) {
            case ProviderEnum::GEMINI:
                //AIzaSyASplF9xWJvbf6bqkv_EA6gHG5US33nqpA
                return new Gemini( $model);
                break;
            case ProviderEnum::OPEN_AI:
                return new OpenAIChats( $model);
                    break;
            default:
                throw new Exception('Ai not found');
                break;
        }
    }

}