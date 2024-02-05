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
     groups/settings
     <div class=" overflow-auto py-4 px-4 bg-white rounded">
        <strong class="text-gray-400">SETTINGS</strong>

        <h1 class="mt-3"><strong>Group Settings</strong></h1>
        @if (Session::has('message'))
            <div class="text-xl text-green-400 py-4 px-2">
                {{ session('message') }}
            </div>
        @endif
        @if (Session::has('errorMessage'))
        <div class="text-xl text-red-400 py-4 px-2">
            {{ session('errorMessage') }}
        </div>
        @endif
        <form action="{{ route('settings.save') }}" method="post">
            @csrf
            @method('post')
        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>

                <label for="">Interest Rate (Non Members(%))</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="non_members_rate" type="number" placeholder="Interest rate e.g 5">
            </div>
            <div>

                <label for="">Interest Rate (Members(%))</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="members_rate" type="number" placeholder="Interest rate e.g 4">
            </div>
            <div>

                <label for="">Default Amount (Welfare)</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="welfare" type="text" placeholder="Enter Amount">
            </div>
            <div>

                <label for="">Default Amount (Disaster & Preparedness)</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="disaster" type="text" placeholder="Enter Amount">
            </div>
            <div>

                <label for="">Default Amount (Shares)</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="shares" type="text" placeholder="Enter Amount">
            </div>
            <div>

                <label for="">Guarantor Pay Rate (%)</label><br>
                <input class="border border-gray-400 rounded py-2 px-2 focus:outline-none" name="guarantor_rate" type="number" placeholder="Pay Rate e.g 2">
            </div>

        </div>
        <x-primary-button class="mt-3">Save settings</x-primary-button>
    </form>
     </div>
    </div>