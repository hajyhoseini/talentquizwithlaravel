<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-indigo-600" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />

                <x-input id="email" class="block mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />

                <x-input id="password" class="block mt-1 w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="ml-4 bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 px-4 py-2 rounded-md">
                    {{ __('Login') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
