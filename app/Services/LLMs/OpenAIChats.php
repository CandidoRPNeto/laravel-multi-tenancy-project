<?php
namespace App\Services\LLMs;
use OpenAI\Laravel\Facades\OpenAI;

class OpenAIChats implements LLMApiInterface{

    private $model;
    private $key;
    private $url;

    public function __construct(array $artf_intelligence){
        $this->model = empty($artf_intelligence['model']) ? 'gemini-1.5-flash': $artf_intelligence['model'];
        $this->key = $artf_intelligence['key'];
        $this->url = empty($artf_intelligence['url']) ? 'https://generativelanguage.googleapis.com/v1beta/models/': $artf_intelligence['url'];
    }

    public  function sendMessage($prompt):string{
        return OpenAI::completions()->create([
            'model' => self::$model,
            'prompt' => $prompt,
            'max_tokens' => 1500
        ])->choices[0]->text;
    }

}