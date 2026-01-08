<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Cutomer Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your license information and  address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('cutomerProfile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="driver_license_number" :value="__('License Number')" />
            <x-text-input id="driver_license_number" name="driver_license_number" type="text" class="mt-1 block w-full" :value="old('driver_license_number', $user->customerProfile->driver_license_number)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('driver_license_number')" />
        </div>

        <div>
            <x-input-label for="license_expiry_date" :value="__('License Expire Date')" />
            <x-text-input id="license_expiry_date" name="license_expiry_date" type="date" class="mt-1 block w-full" :value="old('license_expiry_date', \Carbon\Carbon::parse($user->customerProfile->license_expiry_date)->format('Y-m-d'))" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('license_expire_date')" />
        </div>

        <div>
            <x-input-label for="date_of_birth" :value="__('Date Of Birth')" />
            <x-text-input id="date_of_birth" name="date_of_birth" type="date" class="mt-1 block w-full" :value="old('date_of_birth',\Carbon\Carbon::parse($user->customerProfile->date_of_birth)->format('Y-m-d'))" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Address')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->customerProfile->address)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
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
