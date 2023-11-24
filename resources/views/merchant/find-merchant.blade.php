<x-guest-layout>
    <form method="POST" action="{{ route('find-merchant') }}">
        @csrf
<div>
            <x-input-label for="name" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('emails')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ml-4">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
