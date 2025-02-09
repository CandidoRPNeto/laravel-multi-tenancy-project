<?php
namespace App\Services\LLMs;

use Illuminate\Support\Facades\Http;

class Gemini implements LLMApiInterface{

    private $model;
    private $token;
    private $url;

    public function __construct(array $artf_intelligence){
        $this->model = empty($artf_intelligence['model']) ? 'gemini-1.5-flash': $artf_intelligence['model'];
        $this->token = $artf_intelligence['token'];
        $this->url = 'https://generativelanguage.googleapis.com/v1beta/models/';
    }

    public  function sendMessage($prompt):string{
        $url = $this->url . $this->model . ':generateContent?key=' . $this->token;
        $payload = [ "contents" => [ [ "parts" => [ ["text" => $prompt] ] ] ] ];
        $request = Http::withHeader('Content-Type', 'application/json')->post($url,$payload);
        $body = json_decode($request->body(), true);
        return $body['candidates'][0]['content']['parts'][0]['text'];
    }

}