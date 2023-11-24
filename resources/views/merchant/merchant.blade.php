<x-guest-layout>
    <form method="POST" action="{{ route('merchants.store') }}">
        @csrf

      

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
            

            <x-primary-button class="ml-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
