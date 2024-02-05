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
     loans/loan-Details/non members <br>
     <div class=" w-3/5 max-sm:flex ">
         <input class=" border border-gray-400 rounded py-2 px-2 my-2 focus:outline-none mr-2 w-[85%]" type="search" name="" id="" placeholder="Search...">
        <button type="submit" class=" rounded bg-gray-300 hover:bg-gray-400 py-2 px-2">Search</button>
     </div>
     <div class="bg-white py-4 px-4 rounded-xl">
        @foreach ($details as $detail)
            
        <h2 class="uppercase text-blue-600 mb-4 mx-4 mt-4">Borrower's Bio Information</h2>
        
        <hr>


        <strong class="text-gray-500">Names:</strong> <span>{{ $detail->firstName .' '. $detail->lastName }}</span><br>
        <strong class="text-gray-500">Village:</strong> <span>{{ $detail->village }}</span><br>
        <strong class="text-gray-500">Parish:</strong> <span>{{ $detail->parish }}</span><br>
        <strong class="text-gray-500">Sub-County:</strong> <span>{{ $detail->subCounty }}</span><br>
        <strong class="text-gray-500">District:</strong> <span>{{ $detail->district }}</span><br>
        <strong class="text-gray-500">NIN:</strong> <span></span>{{ $detail->NIN }}<br>
        <strong class="text-gray-500">Contact:</strong> <span>{{ $detail->contact }}</span><br>
        <strong class="text-gray-500">Marital Status:</strong> <span>{{ $detail->maritalStatus }}</span><br>
        <strong class="text-gray-500">Occupation:</strong> <span>{{ $detail->occupation }}</span><br>

        <h2 class="uppercase text-blue-600 mb-4 mx-4 mt-4">Borrower's LC1 Information</h2>

        <hr>

        
        <strong class="text-gray-500">Names:</strong> <span>{{ $detail->LC1Names }}</span><br>
        <strong class="text-gray-500">Contact:</strong> <span>{{ $detail->LC1Contacts }}</span><br>

        <h2 class="uppercase text-blue-600 mb-4 mx-4 mt-4">Borrower's Clan Leader Information</h2>

        <hr>


        <strong class="text-gray-500">Names:</strong> <span>{{ $detail->ClanLeaderNames }}</span><br>
        <strong class="text-gray-500">Contact:</strong> <span>{{ $detail->ClanLeaderContact }}</span><br>

        <h2 class="uppercase text-blue-600 mb-4 mx-4 mt-4">Financial Information</h2>
        
        <hr>

        <strong class="text-gray-500">Amount Requesting For:</strong> <span>{{ $detail->amountRequested }} UGX</span><br>
        <strong class="text-gray-500">Reason:</strong> <span>{{ $detail->reason }}</span><br>


        <h2 class="uppercase text-blue-600 mb-4 mx-4 mt-4">Guarantor's Information</h2>
        <strong class="text-gray-500">Names: </strong><span>{{ $detail->name }}</span>
        <a href="" class="bg-gray-400 py-2 px-4 rounded float-right">View Guarantor's Details</a>


        @endforeach
    </div>
</div>