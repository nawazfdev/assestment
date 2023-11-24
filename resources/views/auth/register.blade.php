<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
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
    <x-input-label for="api_key" :value="__('API Key as Password')" />

    <x-text-input id="api_key" class="block mt-1 w-full"
                    type="password"
                    name="api_key"
                    required autocomplete="new-apikey" />

    <x-input-error :messages="$errors->get('api_key')" class="mt-2" />
</div>

<div>
            <x-input-label for="name" :value="__('Domain')" />
            <x-text-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domainname')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('domain')" class="mt-2" />
        </div>
<div>
            <x-input-label for="name" :value="__('Display Name')" />
            <x-text-input id="displayname" class="block mt-1 w-full" type="text" name="displayname" :value="old('displayname')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('turn_customers_into_affiliates')" />
            <x-text-input id="turn_customers" class="block mt-1 w-full" type="text" name="turn_customers" :value="old('turn_customers_into_affilliate')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('default_commission_rate')" />
            <x-text-input id="commission_rate" class="block mt-1 w-full" type="text" name="commission_rate" :value="old('default_commission_rate')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ml-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
