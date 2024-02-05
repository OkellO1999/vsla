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

        <div>
            <x-input-label for="name" :value="__('NIN')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="nin" :value="old('nin')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('nin')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Contact')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('contact')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Village')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="village" :value="old('village')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('village')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Parish')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="parish" :value="old('parish')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('parish')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('SubCounty')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="subCounty" :value="old('subCounty')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('subCounty')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('District')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="district" :value="old('district')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('district')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Role')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="role" :value="old('role')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Status')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="status" :value="old('status')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
