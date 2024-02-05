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
     loans/requests
     <div class=" overflow-auto py-4 px-4 bg-white">
        @if (count($membersLoanRequests))
      
         <table class=" table-responsive border-1 border-gray-400">

            <tr class="border border-gray-400 py-2 px-4 bg-gray-200">
                <th class="border border-gray-400 py-2 px-4">S No.</th>
                <th class="border border-gray-400 py-2 px-4">Names</th>
                <th class="border border-gray-400 py-2 px-4">Amount Requested</th>
                <th class="border border-gray-400 py-2 px-4">Reason</th>
                <th class="border border-gray-400 py-2 px-4">Contact</th>
                <th class="border border-gray-400 py-2 px-4">Request Date</th>
                <th class="border border-gray-400 py-2 px-4">Actions</th>
            </tr>
            @foreach ($membersLoanRequests as $membersLoanRequest)
            <tr class="border border-gray-400 py-2 px-4">
                    
                <td class="border border-gray-400 py-2 px-4 bg-gray-100">{{ $num++ }}</td>
                <td class="border border-gray-400 py-2 px-4">{{ $membersLoanRequest->name }}</td>
                <td class="border border-gray-400 py-2 px-4">{{ $membersLoanRequest->amount }}</td>
                <td class="border border-gray-400 py-2 px-4"></td>
                <td class="border border-gray-400 py-2 px-4">{{ $membersLoanRequest->contact }}</td>
                <td class="border border-gray-400 py-2 px-4"></td>
                <td>
                    <a href="{{ route('loans.membersApproval',['uid'=>$membersLoanRequest->id]) }}" class="rounded ring-2 ring-offset-transparent ring-orange-400 mx-2 bg-green-600 py-1 px-4 text-white" >Approve</a> 
                </td>
            </tr>
                @endforeach
         </table>
         @else
         <div class="text-red-500 text-xl text-center ">
            {{ __('No loan request(s) found!') }}
         </div>
         @endif
     </div>
    </div>