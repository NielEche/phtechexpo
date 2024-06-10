<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex justify-center py-4">
        <a href="/"> <img class="w-12" src="https://res.cloudinary.com/dx7x2tazo/image/upload/v1713590106/logophtech_faclfs_1_sn2ceq.png" alt=""></a>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="MenloRegular">
            <x-input-label  class="text-white" for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 MenloRegular">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4 MenloRegular">
            <label for="remember_me" class="inline-flex items-center text-white">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-black border-gray-300 dark:border-gray-700 text-black shadow-sm focus:ring-white dark:focus:ring-white-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-white ">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4 MenloRegular">
            <a class="underline text-sm text-white dark:text-white hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('register') }}">
                {{ __('Register?') }}
            </a>


            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
