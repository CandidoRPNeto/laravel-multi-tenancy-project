<?php

namespace App\Http\Controllers\Auth;

use App\Enums\ProviderEnum;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AIProviderController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'provider'=> ['required', Rule::enum(ProviderEnum::class)],
            'token'=> ['required', 'string', 'max:255'],
            'model' => ['nullable', 'string', 'max:255'],
            'url'   => ['nullable', 'string', 'max:255'],
        ]);

        $request->user()->ai_model->update([
            'provider'=> $validated['provider'],
            'token'=> $validated['token'],
            'model'=> $validated['model'],
            'url'=> $validated['url']
        ]);

        return back()->with('status', 'ai-updated');
    }
}
