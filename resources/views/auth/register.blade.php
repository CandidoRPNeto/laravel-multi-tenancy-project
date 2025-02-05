<x-layouts.guest>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <x-input-error :messages="session()->get('error')" class="mt-2"/>

        <!-- Company Name -->
        <div>
            <x-input-label for="company_name" :value="__('Company Name')" />
            <x-text-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus autocomplete="company_name" />
            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>



        <!-- AI Provider -->

        <div class="mt-4">
            <x-input-label for="provider" :value="__('AI Provider')" />

            <select id="provider" :value="old('provider')" name="provider"
                class='w-full rounded-md border-gray-300 shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600'>
                <option value="1">Gemini</option>
                <option value="2">OpenAi</option>
            </select>
            <x-input-error :messages="$errors->get('provider')" class="mt-2" />
        </div>

        <!-- AI Token -->
        <div class="mt-4">
            <x-input-label for="token" :value="__('AI Token')" />
            <x-text-input id="token" class="block mt-1 w-full" type="text" name="token" :value="old('token')" required autofocus autocomplete="token" />
            <x-input-error :messages="$errors->get('token')" class="mt-2" />
        </div>
        <!-- AI Model -->
        <div class="mt-4">
            <x-input-label for="model" :value="__('AI Model')" :required='false'/>
            <x-text-input id="model" class="block mt-1 w-full" type="text" name="model" :value="old('model')" autofocus autocomplete="model" />
            <x-input-error :messages="$errors->get('model')" class="mt-2" />
        </div>
        <!-- AI Url -->
        <div class="mt-4">
            <x-input-label for="url" :value="__('AI Url')" :required='false'/>
            <x-text-input id="url" class="block mt-1 w-full" type="text" name="url" :value="old('url')" autofocus autocomplete="url" />
            <x-input-error :messages="$errors->get('url')" class="mt-2" />
        </div>

        <div class="flex justify-end items-center mt-4">
            <a class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-layouts.guest>
