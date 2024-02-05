@include('layouts.savings')
<div class="h-full px-6 py-4 w-full overflow-auto bg-gray-100">
    <h2 class=" mt-4 mb-4 max-sm:text-center text-gray-400">Withdrawal/<strong>{{ Auth::user()->name }}</strong></h2>
    <div class=" overflow-auto max-sm:block w-full bg-white py-4 px-4 rounded">

    <h1 class=" mb-4 text-center text-gray-400">Withdraw Money</h1>
      <hr>
      @if (Session::has('errorMessage'))
        <div class="bg-red-400 text-white w-full py-2 px-2 rounded">
          {{ session('errorMessage') }}
        </div>
      @endif
      @if (Session::has('message'))
      <div class="bg-green-400 text-white w-full py-2 px-2 rounded">
        {{ session('message') }}
      </div>
    @endif

 <form action="{{ route('verified.withdrawal') }}" method="post" class="grid grid-cols-2 gap-4 mt-4 max-sm:grid-cols-1">
        @csrf
        @method('post')
    
        <div>
          <label for="">Enter Amount To Withdraw</label>
          <input required type="number" value="{{ old('amount') }}" name="amount" id=""  class="border border-gray-300 rounded py-2 px-4 w-full" placeholder ="Amount to withdraw">
        </div>
        <div>
          <label for="">Choose account to withdraw from:</label>
          <select required name="accounts" id="" class="border border-gray-300 rounded py-2 px-4 w-full">
            <option value="" selected disabled>--Choose Account--</option>
            <option value="savings">Savings Account</option>
            <option value="welfare">Welfare Account</option>
            <option value="shares">Shares Account</option>
          </select>
        </div>
      <div></div>

        <div>

        </div>
        <div></div>

          <x-primary-button>
          Confirm withdrawal
        </x-primary-button>
        
 
    </div>
</div>