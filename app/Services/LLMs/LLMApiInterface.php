<?php
namespace App\Services\LLMs;

interface LLMApiInterface {
    public function sendMessage($prompt): string;
}