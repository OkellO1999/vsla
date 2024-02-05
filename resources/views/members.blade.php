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
        <aside class="block w-60 bg-violet-200  overflow-y-scroll h-screen" >
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Total Savings</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Total Interest</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">New Savings</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Savings' Details</h1>
            </div>
       
        </aside>
        
            <div class="h-4/5 bg-white">
                <h2 class="mx-6">Members view</h2>
            </div>
        </div>
        </div>
</body>
</html>