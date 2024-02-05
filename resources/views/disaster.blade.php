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
    <div class="flex w-full h-screen bg-gray-100">
        @include('layouts.sideNav') 
        <div  class="w-screen overflow-auto">
            <div class="inline-grid grid-cols-2 gap-4 w-full">
                <div class="shadow-xl py-12 px-6 my-4 mx-4 rounded-xl bg-white">
                    <h1>Disaster Money at hand(2023)</h1>
                </div>
                <div class="shadow-xl py-12 px-6 my-4 rounded-xl bg-white"><h1>Disaster Activity Details(2023)</h1></div>
            
            </div>
            <div class=" shadow-2xl rounded-xl border-t-4 border-gray-400 mx-4 py-4 px-4 h-full bg-white">
                <h1>Disaster payment details</h1>
        </div>
        </div>
</body>
</html>