<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>


        <div>
            <x-input-label for="gender" :value="__('Gender')" />
          <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" :value="old('gender', $user->gender)" id="gender" name="gender" required autofocus >
                <option value="" selected disabled hidden>Your Gender</option>
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                <option value="other" {{ $user->gender == 'other' ? 'selected' : '' }}>Other</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('gender')" />
        </div>

        <div>
            <x-input-label for="age" :value="__('Age Range')" />
          <select class="block mt-1 w-full rounded-lg text-white bg-black border-black focus:border-black focus:ring-black" :value="old('age', $user->age)" id="age" name="age" required autofocus >
                <option value="" selected disabled>Age Range</option>
                
                <option value="18 - 29 Years" {{ $user->age == '13 - 17 Years' ? 'selected' : '' }}>
                    13 - 17 Years
                </option>
                <option value="18 - 29 Years" {{ $user->age == '18 - 29 Years' ? 'selected' : '' }}>
                    18 - 29 Years
                </option>
                <option value="30 - 39 Years"
                    {{ $user->age == '30 - 39 Years' ? 'selected' : '' }}>
                    30 - 39 Years
                </option>
                <option value="40 - 49 Years"
                    {{ $user->age == '40 - 49 Years' ? 'selected' : '' }}>
                    40 - 49 Years
                </option>
                <option value="50 - 59 Years"
                    {{ $user->age == '50 - 59 Years' ? 'selected' : '' }}>
                    50 - 59 Years
                </option>
                <option value="60 and Above"
                    {{ $user->age == '60 and Above' ? 'selected' : '' }}>
                    60 and Above
                </option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('age')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
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
