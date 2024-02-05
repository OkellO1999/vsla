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
        HOME/add-group-admin
        <form action="{{route('groups.saveAdmin')}}" method="post" class=" py-4 px-4 shadow-xl rounded-xl border-t-4 border-gray-400 w-full mt-4 bg-white">
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
                <input type="text" name="surname" id="" placeholder="Surname" class=" border border-gray-400 focus:outline-none uppercase w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
            <div>
                <label for="">Last Name</label> <span class="text-red-400">*</span>
                <input type="text" name="lastname" id="" placeholder="last name" class=" border border-gray-400 focus:outline-none uppercase w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
            <div>
                <label for="">Othernames</label>
                <input type="text" name="other_names" id="" placeholder="Othernames" class=" border border-gray-400 focus:outline-none uppercase w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
            <div>
                <label for="">Email</label> <span class="text-red-400">*</span>
                <input type="email" name="email" id="" placeholder="Email e.g test@gmail.com" class=" lowercase border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
               <div>
                   <label for="">NIN</label> <span class="text-red-400">*</span><br>
                   <input type="text" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="nin" id="" cols="83" rows="2" placeholder="NIN"/>
               </div>
               <div>
                <label for="">Contact</label> <span class="text-red-400">*</span><br>
                <input type="tel" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="contact" id="" cols="83" rows="2" placeholder="Contact"/>
               </div>
           </div>
           <h2 class=" mt-4 mb-4 text-blue-400">Address Information</h2>
           <hr class="mb-2">
           <div class=" grid grid-cols-2 gap-4 max-sm:grid-cols-1">
            <div>
                <label for="">Village</label> <span class="text-red-400">*</span>
                <input type="text" name="village" id="" placeholder="Village" class=" border border-gray-400 focus:outline-none uppercase w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
            <div>
                <label for="">Parish</label> <span class="text-red-400">*</span>
                <input type="text" name="parish" id="" placeholder="Parish" class=" border border-gray-400 focus:outline-none uppercase w-full px-2 py-2 mb-2 mt-2 rounded">
            </div>
               <div>
                   <label for="">Sub-County</label> <br>
                   <input type="text" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="subCounty" id="" cols="83" rows="2" placeholder="Sub-county"/>
               </div>
               <div>
                <label for="">District</label> <span class="text-red-400">*</span><br>
                <input type="tel" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase" name="district" id="" cols="83" rows="2" placeholder="District"/>
               </div>
               <div>
                <label for="">Group</label> <span class="text-red-400">*</span><br>
                <select name="group" id="" class="border border-gray-400 focus:outline-none w-full px-2 py-2 mb-2 mt-2 rounded uppercase">
                    <option value="" selected disabled>--Choose group--</option>
                    @foreach ($groups as $group)
                        
                    <option class="uppercase text-blue-800" value="{{ $group->id }}">{{ $group->group_name }}</option>
                    @endforeach
                </select>
            </div>
            <div>

            </div>
            <div>
                
            </div>
            <x-primary-button>+ Save</x-primary-button>
        </div>
           
       </form>
       </div>

</x-app-layout>
