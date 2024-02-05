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
    <div  class="w-screen overflow-auto py-4 px-4">
     loans/non-members-loan-details
     <div class=" w-3/5 max-sm:flex float-right">
        <input class=" border border-gray-400 rounded py-2 px-2 my-2 focus:outline-none mr-2 w-[85%]" type="search" name="" id="" placeholder="Search...">
       <button type="submit" class=" rounded bg-gray-300 hover:bg-gray-400 py-2 px-2">Search</button>
    </div>
    <div class=" overflow-x-auto w-full">

    <table class=" table py-2 px-2">
       <tr class=" bg-gray-400">
           <th class=" border border-gray-700">S No.</th>
           <th class=" border border-gray-700">Name</th>
           <th class=" border border-gray-700">NIN</th>
           <th class=" border border-gray-700">Issuing Date</th>
           <th class=" border border-gray-700">Due Date</th>
           <th class=" border border-gray-700">Amount Received</th>
           <th class=" border border-gray-700">Status</th>
           <th class=" border border-gray-700">Fine</th>
           <th class=" border border-gray-700">Amount to be paid</th>
           <th class=" border border-gray-700">Amount paid</th>
           <th class=" border border-gray-700">Balance</th>
       </tr>
       @foreach ($memberDetails as $memberDetail)
           
       <tr class=" border border-gray-400">
           <div class=" sticky left-4">
               <td class=" border border-gray-400 px-2">{{$num++}}</td>
               <td class=" border border-gray-400 px-2">{{ $memberDetail->surname.' '.$memberDetail->other_names  }}</td>
           </div>
           <div class=" overflow-auto">
           <td class=" border border-gray-400 px-2 bg-gray-200">{{ $memberDetail->nin }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-300">{{ $memberDetail->issueDate }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-200">{{ $memberDetail->dueDate }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-300">{{ $memberDetail->loanAmountReceived }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-200">{{ $memberDetail->loanStatus }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-300">{{'00.000' }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-200">{{ $memberDetail->loanAmountReceived+40000 }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-300">{{ '00.000' }}</td>
           <td class=" border border-gray-400 px-2 bg-gray-200">{{ ($memberDetail->loanAmountReceived+40000)-0 }}</td>          
           </div>
       </tr>
       @endforeach
    </table>
    </div>
    </div>