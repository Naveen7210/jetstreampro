<x-app-layout>
    <x-slot name="header">
        <x-nav-link href="{{ url('guestroom') }}" :active="request()->routeIs('guestroom')">
            {{ __('My Rental Rooms') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-welcome />
            </div>
        </div>
    </div>
</x-app-layout>