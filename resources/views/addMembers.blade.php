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
    <div  class="w-full overflow-auto py-4 px-4 bg-gray-100">
        HOME/add-users
        <form action="{{route('admin.addMembers')}}" method="post" class=" py-4 px-4 shadow-xl rounded-xl border-t-4 border-gray-400 w-full mt-4 bg-white">
           @csrf
           @method('post')
           <h2 class=" mt-4 mb-4 text-blue-400">Personal Information</h2>
           <hr class="mb-2">
           @if(Session::has('message'))
           <div class="text-green-500 text-xl py-4 px-3">
               {{ session('message') }}
           </div>
          @endif
          @if(Session::has('errorMessage'))
          <div class="text-red-500 text-xl py-4 px-3">
              {{ session('errorMessage') }}
          </div>
         @endif
           <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <div>
                <label for="">Surname</label> <span class="text-red-400">*</span>
                <input type="text" name="surname" id="" placeholder="Enter Surname" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
            <div>
                <label for="">Last Name</label> <span class="text-red-400">*</span>
                <input type="text" name="lastname" id="" placeholder="Enter given name" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
            <div>
                <label for="">Othernames</label>
                <input type="text" name="other_names" id="" placeholder="Enter other names (Optional)" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 uppercase rounded">
            </div>
            <div>
                <label for="">Email</label> <span class="text-red-400">*</span>
                <input type="email" name="email" id="" placeholder="Email e.g test@gmail.com" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded  lowercase">
            </div>
               <div>
                   <label for="">NIN</label> <span class="text-red-400">*</span><br>
                   <input type="text" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="nin" id="" cols="83" rows="2" placeholder="NIN"/>
               </div>
               <div>
                <label for="">Contact</label> <span class="text-red-400">*</span><br>
                <input type="tel" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded" name="contact" id="" cols="83" rows="2" placeholder="Contact"/>
               </div>
           </div>
           <h2 class=" mt-4 mb-4 text-blue-400">Address Information</h2>
           <hr class="mb-2">
           <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <div>
                <label for="">Village</label> <span class="text-red-400">*</span>
                <input type="text" name="village" id="" placeholder="Village" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
            <div>
                <label for="">Parish</label> <span class="text-red-400">*</span>
                <input type="text" name="parish" id="" placeholder="Parish" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
               <div>
                   <label for="">Sub-County</label> <span class="text-red-400">*</span><br>
                   <input type="text" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="subCounty" id="" cols="83" rows="2" placeholder="Sub-county"/>
               </div>
               <div>
                <label for="">District</label> <span class="text-red-400">*</span><br>
                <input type="tel" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="district" id="" cols="83" rows="2" placeholder="District"/>
               </div>
            </div>
              
         <div></div>
            <x-primary-button>+ Save</x-primary-button>
        </div>
           
       </form>
       </div>
    
