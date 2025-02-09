<?php
namespace App\Services\LLMs;

use Illuminate\Support\Facades\Http;

class Llama implements LLMApiInterface{

    private $model;
    private $key;
    private $url;

    public function __construct(array $artf_intelligence){
        $this->model = empty($artf_intelligence['model']) ? 'gpt-4o': $artf_intelligence['model'];
        $this->key = $artf_intelligence['token'];
        $this->url = 'https://api.llama-api.com/chat/completions';
    }

    public  function sendMessage($prompt):string {
        $payload = [
            "model" => $this->model,
            "messages" => [
                ["role" => "developer","content" => "Your function is to generate JSON configurations with Vega-Lite v5 for JS dashboards."],
                ["role" => "user","content" => $prompt]
            ],
            "stream" => false
        ];
        $request = Http::withHeader('Content-Type', 'application/json')->withHeader('Authorization', "Bearer {$this->key}")->post($this->url,$payload);
        $body = json_decode($request->body(), true);
        return $body['choices'][0]['message']['content'];
    }

}