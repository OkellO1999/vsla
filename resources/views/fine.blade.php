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
                <h1 class="mx-6 font-semibold">Savings</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12">
                <h1 class="mx-6 font-semibold">Disaster</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12 transition-transform delay-500 ease-in-out">
                <h1 class="mx-6 font-semibold">Loans</h1>
            </div>
            <div class="shadow cursor-pointer hover:bg-violet-300 py-12 transition-transform delay-500 ease-in-out">
                <h1 class="mx-6 font-semibold">Welfare</h1>
            </div>
       

        </aside>
   
        <div  class="w-screen overflow-auto">
            <div class=" w-full shadow-xl py-12 px-6 my-4 mx-4 rounded bg-white">
              <select name="" id="" class="">
                <option value="">Select--</option>
              </select>
              <input type="text" name="" id="" placeholder="Amount">
              <button type="submit">Save</button>
            </div>
            <div class=" shadow-2xl rounded-xl border-t-4 border-gray-400 mx-4 py-4 px-4 h-full bg-white"><h1>Fine payment details</h1>
        </div>
    
        </div>
</body>
</html>