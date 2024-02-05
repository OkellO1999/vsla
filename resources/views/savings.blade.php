
@include('layouts.savings')
<div  class="w-screen overflow-auto bg-gray-100 font-sans antialiased">
    <div class="w-full bg-white px-4 py-2 uppercase text-blue-900 ">
        <marquee behavior="smooth" direction="left" class=" hidden max-sm:block">

            <h2>Financial Summary for <span><strong>{{ Auth::user()->name }}</strong> </span></h2> 
        </marquee>
        <h2 class="max-sm:hidden">Financial Summary for <span><strong>{{ Auth::user()->name }}</strong> </span></h2> 


    </div>

    <div class="inline-grid grid-cols-3 gap-4 w-full max-md:grid-cols-2 max-[400px]:grid-cols-1 py-4 px-4">
        <div class="shadow-xl py-2 px-4 rounded-xl  bg-white">
            <h1 class=" mb-2">Your Total Savings By {{ \Carbon\Carbon::now()->format('d-m-Y') }}</h1> 
            <hr>
            @if ($totalIndividualSavings === 0)
            <strong class="mt-2 text-gray-700 ">{{ $totalIndividualSavings}} UGX</strong>
                
            @else
            <strong class="mt-2 text-gray-700 ">{{ $totalIndividualSavings->saved_amount }} UGX</strong>
                
            @endif
        </div>
        <div class="shadow-xl py-2 px-4 rounded-xl  bg-white">
            <h1 class=" mb-2">Interest On Savings ({{ \Carbon\Carbon::now()->format('d-m-Y') }})</h1>
            <hr>
            <strong class="mt-2 text-gray-700 ">{{ $interest }} UGX</strong>
        </div>
        <div class="shadow-xl py-2 px-4 rounded-xl  bg-white">
            <h1 class=" mb-2">Account Balance ({{ \Carbon\Carbon::now()->format('d-m-Y') }})</h1>
            <hr>
            <strong class="mt-2 text-gray-700 ">{{ $withdrawableAmount }} UGX</strong>
            <strong></strong>
        
        </div>
    </div>
    <div class=" shadow-2xl rounded-xl mx-4 py-4 px-4 flex gap-4 border-t-4 border-gray-300 max-md:block bg-white min-h-fit">
        <div class="grid grid-cols-2 h-full gap-4 w-3/5 max-md:grid-cols-2 max-md:w-full max-[400px]:grid-cols-1 max-md:mb-4">
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 bg-white py-4 sticky top-0 ">Current Loan (Savings)</h2>
                <div class="grid grid-cols-1">

                    @if (count($loans))
                    @foreach ($loans as $loan)
                        
                    <strong class="text-gray-400">Amount Borrowed:</strong><span>{{ $loan->loanAmount }}</span>
                    <strong class="text-gray-400">Date:</strong><span>{{ $loan->issueDate }}</span>
                    <strong class="text-gray-400">Due Date:</strong><span>{{ $loan->dueDate }}</span>
                    <strong class="text-gray-400">Amount To Be Paid Back:</strong><span>{{ $loan->payBackAmount }}</span>
                    @endforeach
                    @else
                    <div class="text-blue-900 py-6">
    
                        {{ __('You currently have no loan(s) on savings, Thanks!') }}
                    </div>
                    @endif
                </div>
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 bg-white py-4 sticky top-0">Current Loan (Welfare)</h2>
                @if (count($welfareLoans))
                @foreach ($welfareLoans as $welfareLoan)
                    
                <strong class="text-gray-400">Amount Borrowed:</strong><span>{{ $welfareLoan->loanAmount }}</span>
                <strong class="text-gray-400">Date:</strong><span>{{ $welfareLoan->issueDate }}</span>
                <strong class="text-gray-400">Due Date:</strong><span>{{ $welfareLoan->dueDate }}</span>
                <strong class="text-gray-400">Amount To Be Paid Back:</strong><span>{{ $welfareLoan->payBackAmount }}</span>
                @endforeach
                @else
                <div class="text-blue-900 py-6">

                    {{ __('You currently have no loan(s) on welfare, Thanks!') }}
                </div>
                @endif
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 bg-white py-4 sticky top-0">Welfare Paid</h2>
                @if(count($welfareLoans))
                @foreach ($welfareLoans as $welfareLoan)
                <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white">{{ $welfareLoan->loanAmount }}</span>
                <strong class="text-gray-400">Amount Paid:</strong><span>{{ $welfareLoan->issueDate }}</span>
                <strong class="text-gray-400">Balance to be paid:</strong><span>{{ $welfareLoan->dueDate }}</span>
                @endforeach
                @else
                <div class="text-blue-900 grid grid-cols-1 py-6">
                    <div>

                        <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white"> {{ 50000 }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Amount Paid:</strong><span> {{ __('0') }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Balance to be paid:</strong><span> {{ __('50000') }} UGX</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 bg-white py-4 sticky top-0">Shares</h2>
                @if (count($welfareLoans))
                @foreach ($welfareLoans as $welfareLoan)
                    
                <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white">{{ $welfareLoan->loanAmount }}</span>
                <strong class="text-gray-400">Amount Paid:</strong><span>{{ $welfareLoan->issueDate }}</span>
                <strong class="text-gray-400">Balance to be paid:</strong><span>{{ $welfareLoan->dueDate }}</span>
                @endforeach
                @else
                <div class="text-blue-900 grid grid-cols-1 py-6">
                    <div>

                        <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white"> {{ 50000 }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Amount Paid:</strong><span> {{ __('0') }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Balance to be paid:</strong><span> {{ __('50000') }} UGX</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 bg-white py-4 sticky top-0">Disaster & preparedness Paid</h2>
                @if (count($welfareLoans))
                @foreach ($welfareLoans as $welfareLoan)
                    
                <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white">{{ $welfareLoan->loanAmount }}</span>
                <strong class="text-gray-400">Amount Paid:</strong><span>{{ $welfareLoan->issueDate }}</span>
                <strong class="text-gray-400">Balance to be paid:</strong><span>{{ $welfareLoan->dueDate }}</span>
                @endforeach
                @else
                <div class="text-blue-900 grid grid-cols-1 py-6">
                    <div>

                        <strong class="text-gray-400">Default Amount:</strong><span class=" font-bold bg-blue-600 text-white"> {{ 50000 }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Amount Paid:</strong><span> {{ __('0') }} UGX</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Balance to be paid:</strong><span> {{ __('50000') }} UGX</span>
                    </div>
                </div>
                @endif
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 scroll-m-0 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 sticky top-0 bg-white py-4">Guarantee Loan Status</h2>
                @if (count($guarantee))
                    
                @foreach ($guarantee as $guarante)
                    
                <div class="grid grid-cols-1 border border-gray-200 py-2 px-2 mt-2 rounded">
                    <div>

                        <strong class="text-gray-400">Names:</strong><span> {{ $guarante->firstName .' '. $guarante->lastName }}</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Amount Borrowed:</strong><span> {{ $guarante->payBackAmount }}</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Date Acquired:</strong><span> {{ $guarante->issueDate }}</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Due Date:</strong><span> {{ $guarante->dueDate }}</span>
                    </div>
                    <div>

                        <strong class="text-gray-400">Status:</strong><span> {{ $guarante->loanStatus }}</span>
                    </div>
                </div>
                @endforeach
                @else
                <div class="text-blue-900 py-6">

                    {{ __('You are currently not a guarantor to anyone with pending loan(s), Thanks!') }}
                </div>
                @endif

            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 min-h-full pb-4 px-4">
                <h2 class=" border-b border-gray-400 sticky top-0 bg-white py-4">Financial Summary</h2>
                <div  class="border border-gray-200 border-collapse rounded grid grid-cols-1  mt-2  py-2 px-2 bg-gray-100">
                    <strong class="text-blue-600">Savings</strong>
                    <div>
                        @if(count($savings))
    
                        <strong class="text-gray-400">Total Savings:</strong><span> {{ $savings[0]->saved_amount }} UGX</span>
                        @else
                        <strong class="text-gray-400">Total Savings:</strong><span> {{ __('0') }} UGX</span>
                        @endif
                    </div>

                </div>
                <div  class="border border-gray-200 border-collapse rounded grid grid-cols-1  mt-2  py-2 px-2 bg-gray-100">
                    <strong class="text-blue-600">Welfare</strong>
                    <div>
                        @if (count($welfare))
                            
                        <strong class="text-gray-400">Amount:</strong><span> {{ $welfare[0]->welfare_paid }} UGX</span>
                        @else
                        <strong class="text-gray-400">Amount:</strong><span> {{ __('0') }} UGX</span>
                            
                        @endif
                    </div>

                </div>
                <div  class="border border-gray-200 border-collapse rounded grid grid-cols-1  mt-2  py-2 px-2 bg-gray-100">
                    <strong class="text-blue-600">Disaster</strong>
                    <div>
                        @if (count($disaster))
                            
                        <strong class="text-gray-400">Amount:</strong><span> {{ $disaster[0]->disaster_amount_paid }} UGX</span>
                        @else
                        <strong class="text-gray-400">Amount:</strong><span> {{ __('0') }} UGX</span>
                            
                        @endif
                    </div>

                </div>
                <div  class="border border-gray-200 border-collapse rounded grid grid-cols-1  mt-2  py-2 px-2 bg-gray-100">
                    <strong class="text-blue-600">Shares</strong>
                    <div>
                        @if (count($shares))
                        <strong class="text-gray-400">Amount:</strong><span> {{ $shares[0]->shareAmount }}</span>
                        
                        @else
                        <strong class="text-gray-400">Amount:</strong><span> {{ __('0') }} UGX</span>
                            
                        @endif
                    </div>

                </div>


            </div>
        </div>
        <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-screen pb-4 px-4 w-2/5 overflow-x-auto max-md:w-full">
            <h2 class="border-b border-gray-400 sticky top-0 bg-white py-4">Transaction History</h2>
            {{-- <hr class="border border-gray-300"> --}}
            @if (count($transactionsHistory))
                
            @foreach ($transactionsHistory as $transactionHistory)
                
            <a href=""  class="border border-gray-200 border-collapse rounded grid grid-cols-1  mt-2  py-2 px-2">
                <div>

                    <strong class="text-gray-400">Transaction Type:</strong><span> {{ $transactionHistory->transactionType }}</span>
                </div>
                <div>

                    <strong class="text-gray-400">Transaction Date & time:</strong><span> {{ $transactionHistory->created_at }}</span>
                </div>
                <div>

                    <strong class="text-gray-400">Amount:</strong><span> {{ $transactionHistory->amount }} UGX</span>
                </div>
            </a>
           
            @endforeach
            @else
            <div class="text-blue-900 py-6">

                {{ __('No transaction record found !') }}
            </div> 
            @endif
        </div>
    </div>
</div>
</div>