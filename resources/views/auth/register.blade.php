<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Full Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address  -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input id="phone_number" class="block  mt-1 w-full" type="text" name="phone_number" :value="old('phone_number')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
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
<div class="relative flex py-5 mt-4 items-center">
    <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
    <span class="flex-shrink mx-4 px-1 text-gray-400 text-sm uppercase">Customer Information</span>
    <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
</div>
        <!-- Driver License Number-->
        <div class="mt-4">
            <x-input-label for="driver_license" :value="__('Driver License Number')" />
            <x-text-input id="driver_license" class="block  mt-1 w-full" type="text" name="driver_license_number" :value="old('driver_license_number')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('driver_license')" class="mt-2" />
        </div>

        <!-- License Expire Date -->
        <div class="mt-4">
            <x-input-label for="license_expire_date" :value="__('License Expire Date')" />
            <x-text-input id="license_expire_date" class="block  mt-1 w-full" type="date" name="license_expiry_date" :value="old('license_expire_date')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('license_expire_date')" class="mt-2" />
        </div>

        <!-- Date Of Birth -->
        <div class="mt-4">
            <x-input-label for="date_of_birth" :value="__('Date Of Birth')" />
            <x-text-input id="date_of_birth" class="block  mt-1 w-full" type="date" name="date_of_birth" :value="old('date_of_birth')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="mt-4">
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" class="block  mt-1 w-full" type="text" name="address" :value="old('address')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('address')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
