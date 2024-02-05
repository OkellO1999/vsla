<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
   
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body>
    @include('layouts.usernav')
    @include('layouts.loans')
    <div  class="w-screen overflow-auto py-4 px-4 bg-gray-100">
     loans/Approve-Loan/Members
     <div class=" overflow-auto py-4 px-4 bg-white rounded">

       <form action="{{ route('loans.handleMembersApproval') }}" method="post" class="grid grid-cols-2 gap-4">
        @csrf
        @method('post')
        {{-- @if (Session::has('success'))
            {{ Session('success') }}
        @endif --}}
        @foreach ($approvalInfo as $approval)
            <input type="hidden" name="group_id" value="{{ $approval->group_id }}">
            <input type="hidden" name="id" value="{{ $approval->id }}">
            <input type="hidden" name="user_id" value="{{ $approval->user_id }}">
        <div>
            <label for="">Creditor Name <span class="text-red-400">*</span></label><br>
            <input name="guarantor" disabled type="text" value="{{ $approval->name }}" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
        </div>
        <div>
            <label for="">Amount to be given (UGX)<span class="text-red-400">*</span></label><br>

            <input name="givenAmount" type="text" value="{{ $approval->amount }}" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
        </div>
        <div>
            <label for="">Interest Rate (%)<span class="text-red-400">*</span></label><br>

            <input name="interestRate" type="hidden" value="5" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 ">
            <input name="" disabled type="text" value="5" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 ">
        </div>
        <div>
            <label for="">Request Date <span class="text-red-400">*</span></label><br>

        <input name="requestDate" type="hidden" value="{{ \Carbon\Carbon::parse($approval->created_at)->format('d-m-Y') }}" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
        <input name="" type="text" disabled value="{{ \Carbon\Carbon::parse($approval->created_at)->format('d-m-Y') }}" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
        </div>
        <div>
            <label for="">Payment Period <span class="text-red-400">*</span></label><br>

        <select name="paymentPeriod" id="" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
            <option value="" selected disabled>Select Period of payment</option>
            <option value="1">1 Month</option>
            <option value="2">2 Months</option>
            <option value="3">3 Months</option>
            <option value="4">4 Months</option>
            <option value="5">5 Months</option>
            <option value="6">6 Months</option>
            <option value="7">7 Months</option>
            <option value="8">8 Months</option>
            <option value="9">9 Months</option>
            <option value="10">10 Months</option>
            <option value="11">11 Months</option>
            <option value="12">1 Year</option>
        </select>
        </div>
        <div>
            <label for="">Payment Sequence <span class="text-red-400">*</span></label><br>

        <select name="paymentSequence" id="" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
            <option value="" selected disabled>Select payment Sequence</option>
            <option value="30">Daily</option>
            <option value="4">Weekly</option>
            <option value="1">Monthly</option>
            <option value="3">After Every Three Months</option>
            <option value="12">Yearly</option>
            
        </select>
        </div>
        <div>
            <label for="">Contact <span class="text-red-400">*</span></label><br>

        <input name="borrowerContact" type="text" value="{{ $approval->contact }}" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
        </div>
        <div>
            <label for="">Payment Method <span class="text-red-400">*</span></label><br>

        <select name="paymentMethod" id="" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
            <option value="" selected disabled>Select payment Method</option>
            <option value="MTN">MTNMobileMoney</option>
            <option value="Airtel">AirtelMoney</option>
            
        </select>
        </div>
        <div></div>
        <div>
            <label for="">Complete payment with: <span class="text-red-400">*</span></label><br>

        <select name="completePaymentWith" id="" class="border border-gray-300 rounded py-2 px-4 w-full text-blue-900 focus:outline-none">
            <option value="" selected disabled>Select account to complete payment</option>
            <option value="savings">Savings Account</option>
            <option value="shares">Shares Account</option>
            <option value="welfare">Welfare Account</option>
            
        </select>
        </div>
        <div class="text-gray-500"><span class="text-red-400 font-bold">NOTE: </span>Clicking <span class="font-bold text-blue-600"> CONFIRM APPROVAL</span> button will automatically send the money to the contact shown in the contact field</div>
        <x-primary-button>confirm approval</x-primary-button>
        @endforeach

       </form>
      </div>    
     </div>
    </div>