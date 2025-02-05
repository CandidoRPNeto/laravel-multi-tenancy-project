<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Update AI') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Change the ai service.') }}
        </p>
    </header>

    <form method="post" action="{{ route('ai.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')


        <!-- AI Provider -->

        <div class="mt-4">
            <x-input-label for="provider" :value="__('AI Provider')" />

            <select id="provider" :value="old('provider', $user->ai_model->provider)" name="provider"
                class='w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600'>
                <option value="2">OpenAi</option>
                <option value="1">Gemini</option>
            </select>
            <x-input-error :messages="$errors->get('provider')" class="mt-2" />
        </div>

        <!-- AI Token -->
        <div class="mt-4">
            <x-input-label for="token" :value="__('AI Token')" />
            <x-text-input id="token" class="block mt-1 w-full" type="text" name="token" :value="old('token', $user->ai_model->token)" required autofocus autocomplete="token" />
            <x-input-error :messages="$errors->get('token')" class="mt-2" />
        </div>
        <!-- AI Model -->
        <div class="mt-4">
            <x-input-label for="model" :value="__('AI Model')" :required='false'/>
            <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model', $user->ai_model->model)" autofocus autocomplete="model" />
            <x-input-error :messages="$errors->get('model')" class="mt-2" />
        </div>
        <!-- AI Url -->
        <div class="mt-4">
            <x-input-label for="url" :value="__('AI Url')" :required='false'/>
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url', $user->ai_model->url)" autofocus autocomplete="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="flex gap-4 items-center">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'ai-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
