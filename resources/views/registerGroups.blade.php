<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-700 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <hr class="border-4 border-black">
    <hr class="border-4 border-yellow-500">
    <hr class="border-4 border-red-500">
    @include('layouts.loans')

    <div  class="w-full overflow-auto py-4 px-4 bg-gray-100">
        HOME/add-group
        <form action="{{ route('groups.save') }}" method="post" class=" py-4 px-4 shadow-xl rounded-xl border-t-4 border-gray-400 w-full mt-4 bg-white">
           @csrf
           @method('post')
           <h2 class=" mt-4 mb-4 text-blue-400">Group Info</h2>
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
                <label for="">Group Name</label>
                <input type="text" name="group_name" id="" placeholder="Group name" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
            <div>
                <label for="">Location</label>
                <input type="text" name="location" id="" placeholder="Location" class=" border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
            </div>
               <div>
                   <label for="">Description</label> <br>
                   <textarea class=" border border-gray-400 rounded px-2 focus:outline-none capitalize" name="description" id="" cols="83" rows="2" placeholder="Short notes about the group"></textarea>
               </div>
               <div>
                   
               </div>
           </div>
           <x-primary-button class="mt-3">+ Add Group</x-primary-button>
           
           
       </form>
       </div>

</x-app-layout>
