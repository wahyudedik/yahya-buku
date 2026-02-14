<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <h2 class="text-2xl font-bold text-gray-900 text-center mb-6">Welcome Back</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-medium" />
            <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />

            <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-blue-600 focus:ring-blue-600 rounded-lg shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-6">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-blue-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="ms-3 inline-flex items-center px-4 py-2 bg-[#002B8F] border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-800 focus:bg-blue-800 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
