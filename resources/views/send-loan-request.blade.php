@include('layouts.savings')
<div class="h-full px-6 py-4 w-full overflow-auto bg-gray-100">
    <h2 class=" mt-4 mb-4 max-sm:text-center text-gray-400">Send-request/<strong>{{ Auth::user()->name }}</strong></h2>
    <div class=" overflow-auto max-sm:block w-full bg-white py-4 px-4 rounded">
      
          
    <h1 class=" mb-4 text-center text-gray-400">Make your loan requests here</h1>
      <hr>
      <form action="{{ route('loans.getRequest') }}" method="post">
        @method('post')
        @csrf
        <div class="space-y-6">

          <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Loan requests') }}
            </h2>
            @if (Session::has('errorMessage'))
                <div class="text-red-500 text-xl">{{ session('errorMessage') }}</div>
            @endif
            @if (Session::has('message'))
            <div class="text-green-500 text-xl">{{ session('message') }}</div>
            @endif
            <div class="mt-1 text-sm grid grid-cols-2 gap-4 text-gray-600">
                <div>

                    <label for="">Amount requesting for</label>
                    <x-text-input name="amount" class="border-gray-400 border rounded mt-3" placeholder="Amount"/>
                </div>
                <div>
                    <label for="">Choose Loan Type</label>
                    <select name="loanType" id="" class="border border-gray-400 mt-3 rounded w-full py-2 ">
                        <option value="" selected disabled>Choose Loan Type</option>
                        <option value="savings">Savings Loan</option>
                        <option value="welfare">Welfare Loan</option>
                    </select>
                </div>
                <div>
                        <label for="">Reason</label>
                    <textarea name="reason" id="" cols="75" class="border border-gray-400 rounded py-2 px-4" rows="3" placeholder="Enter reason"></textarea>
                </div>
            </div>
        </header>
        
        
        
        
        <x-primary-button
        
        >{{ __('send request ->') }}</x-primary-button>
    </form>
        

    </div>

</div>