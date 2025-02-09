<?php
namespace App\Services\LLMs;

use Illuminate\Support\Facades\Http;

class Grok implements LLMApiInterface{

    private $model;
    private $key;
    private $url;

    public function __construct(array $artf_intelligence){
        $this->model = empty($artf_intelligence['model']) ? 'grok-2-latest': $artf_intelligence['model'];
        $this->key = $artf_intelligence['token'];
        $this->url = 'https://api.x.ai/v1/chat/completions';
    }

    public  function sendMessage($prompt):string {
        $payload = [
            "model" => $this->model,
            "messages" => [
                ["role" => "system","content" => "Your function is to generate JSON configurations with Vega-Lite v5 for JS dashboards."],
                ["role" => "user","content" => $prompt]
            ],
            "stream" => false,
            "temperature" => 0
        ];
        $request = Http::withHeader('Content-Type', 'application/json')->withHeader('Authorization', "Bearer {$this->key}")->post($this->url,$payload);
        $body = json_decode($request->body(), true);
        return $body['choices'][0]['message']['content'];
    }

}