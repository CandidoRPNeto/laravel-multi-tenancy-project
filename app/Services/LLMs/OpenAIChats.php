<?php
namespace App\Services\LLMs;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIChats implements LLMApiInterface{
    public function __construct(private string $key, private string $model){

    }

    public  function sendMessage($prompt):string{
        return OpenAI::completions()->create([
            'model' => self::$model,
            'prompt' => $prompt,
            'max_tokens' => 1500
        ])->choices[0]->text;
    }

}