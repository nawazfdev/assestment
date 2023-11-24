

<x-guest-layout>
<form action="{{ route('register-affiliate') }}" method="post">
    @csrf
<div>
            <x-input-label for="name" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('emails')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="name" :value="__('Commission Rate:')" />
            <x-text-input id="commission_rate" class="block mt-1 w-full"  step="0.01" type="number"  name="commission_rate" :value="old('Commission Rate')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
             
        </div>
        <div>
            <x-input-label for="name" :value="__('Disocunt Code:')" />
            <x-text-input id="discount_code" class="block mt-1 w-full"    type="number"  name="discount_code" :value="old('Commission Rate')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
             
        </div>
        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ml-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
