<?php
namespace App\Services\LLMs;

use Illuminate\Support\Facades\Http;

class Gemini implements LLMApiInterface{
    public function __construct(private string $key, private string $model){

    }

    public  function sendMessage($prompt, $model = 'gpt-3.5-turbo-instruct'):string{
        $url = 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key='.$this->key;
        $payload = [ "contents" => [ [ "parts" => [ ["text" => $prompt] ] ] ] ];
        $request = Http::withHeader('Content-Type', 'application/json')->post($url,$payload);
        $body = json_decode($request->body(), true);
        $response = $body['candidates'][0]['content']['parts'][0]['text'];
        return $response;
    }

}