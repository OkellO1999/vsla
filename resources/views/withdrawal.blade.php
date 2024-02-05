@include('layouts.savings')
<div class="h-full px-6 py-4 w-full overflow-auto bg-gray-100">
    <h2 class=" mt-4 mb-4 max-sm:text-center text-gray-400">Verification/<strong>{{ Auth::user()->name }}</strong></h2>
    <div class=" overflow-auto max-sm:block w-full bg-white py-4 px-4 rounded">
      
          
    <h1 class=" mb-4 text-center text-gray-400">Verify Account</h1>
      <hr>
        <div class="space-y-6">

          <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Account Verification') }}
            </h2>
    
            <p class="mt-1 text-sm text-gray-600">
                {{ __('For security purposes, we request you to verify its you by confirming your password!') }}
            </p>
        </header>




          <x-primary-button
          x-data=""
          x-on:click.prevent="$dispatch('open-modal', 'confirm-user-withdrawal')"
      >{{ __('verify account') }}</x-primary-button>
        

    <x-modal name="confirm-user-withdrawal" :show="$errors->userWithdrawal->isNotEmpty()" focusable >
        <form method="post" action="{{ route('savings.confirmPassword') }}" class="p-6">
            @csrf
            @method('post')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Please Confirm its you ') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Type in the password for this account to proceed.') }}
            </p>


            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userWithdrawal->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-primary-button class="ml-3">
                    {{ __('confirm') }}
                </x-primary-button>
            </div>
        </form>
    </x-modal>
    </div>
      {{-- </form>
            
    </div> --}}
</div>