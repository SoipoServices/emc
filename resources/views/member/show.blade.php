<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ $member->name }}
        </h2>
    </x-slot>

    <div class="py-12">
         <x-user-card :member=$member/>
    </div>


</x-app-layout>
