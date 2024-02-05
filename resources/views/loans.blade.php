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
    <div  class="w-full overflow-scroll h-screen bg-gray-100">
        <div class="inline-grid grid-cols-3 gap-4 w-full max-md:grid-cols-2 max-[400px]:grid-cols-1 px-4 py-4">
            <div class="shadow-xl py-12 px-6  rounded-xl  bg-white">
                <h1>Members with loans(2023)</h1>
            </div>
            <div class="shadow-xl py-12 px-6  rounded-xl bg-white"><h1>Non Members with loans(2023)</h1></div>
            <div class="shadow-xl py-12 px-6  rounded-xl bg-white"><h1>Members with passed due payment Date (2023)</h1></div>
            <div class="shadow-xl py-12 px-6  rounded-xl bg-white"><h1>Non Members with passed due payment Date (2023)</h1></div>
            <div class="shadow-xl py-12 px-6  rounded-xl bg-white"><h1>Total Loans on members (2023)</h1></div>
            <div class="shadow-xl py-12 px-6  rounded-xl bg-white"><h1>Total Loans on non members (2023)</h1></div>
        </div>
        <div class=" shadow-2xl rounded-xl border-t-4 border-gray-300 mx-4 py-4 px-4 flex gap-4 h-full max-md:block bg-white">
            <div class="grid grid-cols-2 gap-4 w-3/5  max-md:w-full max-md:mb-6 max-[400px]:grid-cols-1 ">
                <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-full py-4 px-4">
                    <h2 class=" border-b border-gray-400">Pending Loan Requests</h2>
                </div>
                <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-full py-4 px-4">
                    <h2 class=" border-b border-gray-400">Pending Loan requests (Non Members)</h2>
                </div>
                <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-full py-4 px-4">
                    <h2 class=" border-b border-gray-400">Approved Loan Requests</h2>
                </div>
                <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-full py-4 px-4">
                    <h2 class=" border-b border-gray-400">Paid amount(2023)</h2>
                </div>
            </div>
            <div class="rounded-xl shadow-xl border-t-4 border-gray-500 h-11/12 py-4 px-4 w-2/5 max-md:w-full max-md:mt-8">
                <h2>Notifications <span class=" animate-pulse font-extrabold text-3xl">...</span></h2>
                <hr class="border border-gray-300">
            </div>
        </div>
    </div>
    </div>