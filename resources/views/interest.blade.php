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
        <aside class="block w-60 bg-violet-200  overflow-auto h-full" >
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Total Savings</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Total Interest</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12 transition-transform delay-500 ease-in-out">
                <h1 class="mx-6 font-semibold">New Savings</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Savings' Details</h1>
            </div>
       
        </aside>
        <div  class="w-screen">
            <div class="inline-grid grid-cols-3 gap-4 w-full">
                <div class="shadow-xl py-12 px-6 my-4 mx-4 rounded-xl bg-white">
                    <h1>Total Savings</h1>
                </div>
                <div class="shadow-xl py-12 px-6 my-4 rounded-xl bg-white"><h1>Total Interest</h1></div>
                <div class="shadow-xl py-12 px-6 my-4 mx-4 rounded-xl bg-white"><h1>Details of Savings</h1></div>
            </div>
            <div class="h-4/6 shadow-2xl rounded-xl bg-white mx-4 py-4 px-4 transition ease-in-out delay-75">
                <h2>Savings</h2>
            </div>
        </div>
        </div>
</body>
</html>