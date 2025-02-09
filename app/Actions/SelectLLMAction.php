<?php
namespace App\Actions;

use App\Enums\ProviderEnum;
use App\Services\LLMs\Deepseek;
use App\Services\LLMs\Gemini;
use App\Services\LLMs\Grok;
use App\Services\LLMs\Llama;
use App\Services\LLMs\LLMApiInterface;
use App\Services\LLMs\OpenAIChats;
use Exception;

class SelectLLMAction {

    public static function execute():  LLMApiInterface{
        $model = session()->get('model');
        switch ($model['provider']) {
            case ProviderEnum::GEMINI:
                return new Gemini( $model);
                break;
            case ProviderEnum::OPEN_AI:
                return new OpenAIChats( $model);
                    break;
            case ProviderEnum::GROK:
                return new Grok( $model);
                    break;
            case ProviderEnum::LLAMA:
                return new Llama( $model);
                    break;
            case ProviderEnum::DEEPSEEK:
                return new Deepseek( $model);
                    break;
            default:
                throw new Exception('Ai not found');
                break;
        }
    }

}