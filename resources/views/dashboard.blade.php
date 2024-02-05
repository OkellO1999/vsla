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

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden grid grid-cols-2 gap-4">
                <a href="" class="py-8 hover:bg-slate-50 text-gray-900 rounded bg-white text-center">
                    {{ __("Add group!") }}
                </a>
                <a href="" class="py-8 hover:bg-slate-50 text-gray-900 rounded bg-white text-center">
                    {{ __("Add Group Admin/Chairperson!") }}
                </a>
                <a href="" class="py-8 hover:bg-slate-50 text-gray-900 rounded bg-white text-center">
                    {{ __("Manage groups!") }}
                </a>
                <a href="" class="py-8 hover:bg-slate-50 text-gray-900 rounded bg-white text-center">
                    {{ __("Manage Group Admin/Chairperson!") }}
                </a>
            </div>
        </div>
    </div>


</x-app-layout>
