<?php

namespace App\Models;

use App\Enums\ProviderEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AIModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'provider',
        'token',
        'model',
        'url',
        'user_id'
    ];

    protected $table = 'ai_models';

    protected function casts(): array {
        return [
            'provider' => ProviderEnum::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    protected static function booted()
    {
        static::updating(function ($ai_model) {
            if(session()->has('model')) session()->put('model', [
                'provider'=> $ai_model->provider,
                'token'=> $ai_model->token,
                'model'=> $ai_model->model,
                'url'=> $ai_model->url
            ]);
        });
    }
}
