
          
          <div class="grid grid-cols-1">

            @if (Auth::user()->role === 'admin' || Auth::user()->role === 'member' || Auth::user()->role === 'secretary' || Auth::user()->role === 'disaster' || Auth::user()->role === 'loan_officer')
              
            <x-nav-link :href="route('savings.index')" :active="request()->routeIs('savings.index')" class="shadow py-10 px-4">
            {{ __('Financial Summary') }}
            </x-nav-link>
            
            
            <x-nav-link :href="route('loans.sendRequest')" :active="request()->routeIs('loans.sendRequest')" class="shadow py-10 px-4">
                {{ __('Request a loan') }}
            </x-nav-link>
            
            @endif


              <x-nav-link :href="route('savings.addSavings')" :active="request()->routeIs('savings.addSavings')" class="shadow py-10 px-4">
                 {{__('Payments')}}
              </x-nav-link> 
              @if(Auth::user()->role === 'secretary')
              <x-nav-link :href="route('admin.register')" :active="request()->routeIs('admin.register')" class="shadow py-10 px-4">
                  {{ __('Add Group Members') }}
              </x-nav-link>
              @endif
              @if(Auth::user()->role === 'loan_officer')
              <x-nav-link :href="route('loans.loanRequest')" :active="request()->routeIs('loans.loanRequest')" class="shadow py-10 px-4">
                  {{ __('Loan Requests (Non Members)') }}
              </x-nav-link>
              <x-nav-link :href="route('loans.loanRequestMembers')" :active="request()->routeIs('loans.loanRequestMembers')" class="shadow py-10 px-4">
                  {{ __('Loan Requests (Members)') }}
              </x-nav-link>
              @endif
              @if ( Auth::user()->role === 'admin' || Auth::user()->role === 'member' || Auth::user()->role === 'secretary' || Auth::user()->role === 'disaster' || Auth::user()->role === 'loan_officer')
                  @if(Auth::user()->verified === 0)
                      
                  <x-nav-link :href="route('savings.withdraw')" :active="request()->routeIs('savings.withdraw')" class="shadow py-10 px-4">
                      {{ __('Withdraw Money') }}
                  </x-nav-link>
                  @else
                  <x-nav-link :href="route('savings.verified')" :active="request()->routeIs('savings.verified')" class="shadow py-10 px-4">
                      {{ __('Withdraw Money') }}
                  </x-nav-link>
                  @endif
              @endif
              <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="shadow py-10 px-4">
                  {{ __('Register User') }}
              </x-nav-link>
              @if (Auth::user()->role === 'admin')
                  
              <x-nav-link :href="route('settings.index')" :active="request()->routeIs('settings.index')" class="shadow py-10 px-4">
                  {{ __('Settings') }}
              </x-nav-link>
              @endif
          </div>

        
