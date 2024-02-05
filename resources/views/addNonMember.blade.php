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
     loans/record-non-member
     <form action="{{ route('loans.nonMembersRequest') }}" method="post" class=" py-4 px-4 shadow-xl rounded-xl border-t-4 border-gray-400 w-full mt-4 bg-white">
        @csrf
        @method('post')
        <h2 class=" mt-4 mb-4 text-blue-400">Personal Information</h2>
        <hr class="mb-2">
        <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <input type="text" name="surname" id="" placeholder="Surname" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="text" name="other_names" id="" placeholder="Othernames" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <div>
                <label for="" class=" text-gray-700 font-bold">Marital Status</label> <br>
                <input type="radio" name="maritalStatus" value="Single" id=""> Single
                <input type="radio" name="maritalStatus" value="Married" id=""> Married
            </div>
            <input type="text" name="occupation" id="" placeholder="Occupation" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        </div>
        <h2 class=" mt-4 mb-4 text-blue-400">Address</h2>
        <hr class="mb-2">
        <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <input type="text" name="village" id="" placeholder="Village" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="text" name="parish" id="" placeholder="Parish"class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="text" name="subCounty" id="" placeholder="Sub-county" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="text" name="district" id="" placeholder="District" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        </div>
        <h2 class=" mt-4 mb-4 text-blue-400">Contact Information</h2>
        <hr class="mb-2">
        <div class=" grid grid-cols-3 gap-4 max-sm:grid-cols-1">
           
            <input type="text" name="nin" id="" placeholder="NIN" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded ">
            <input type="email" name="email" id="" placeholder="Email e.g info@vsla.com (OPTIONAL)" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="tel" name="contact" id="" placeholder="Contact e.g 0784973828" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        </div>
        <h2 class=" mt-4 mb-4 text-blue-400">Referees Info</h2>
        <hr class="mb-2">
        <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <input type="text" name="lc1names" id="" placeholder="LC1 Full Names" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="tel" name="lc1contact" id="" placeholder="LC1 Phone number" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="text" name="clanLeaderNames" id="" placeholder="Clan Leader Full Names" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <input type="tel" name="clanLeaderContact" id="" placeholder="Clan Leader Phone number" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        </div>
        <h2 class=" mt-4 mb-4 text-blue-400">Guarantor</h2>
        <hr class="mb-2">

        <select name="guarantor" id="" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            <option value="" selected disabled>Select Guarantor</option>
            @foreach ($guarantor as $gurantor)
            <option value="{{ $gurantor->id }}">{{ $gurantor->name }}</option>
                
            @endforeach
        </select>
        <h2 class=" mt-4 mb-4 text-blue-400">Financial Request Info</h2>
        <hr class="mb-2">
        <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
        <input type="text" name="requestedAmount" id="" placeholder="Amount Requesting For..." class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        <input type="text" name="reason" id="" placeholder="Reason" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
        </div>
        <button type="submit" class=" bg-green-500 text-white py-4 px-6 rounded-xl font-semibold max-sm:w-full">Send Request</button>
    </form>
    </div>