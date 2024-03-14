<style>

    form{
        margin: 3%;
    }
    .formdiv{
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 20px;
        row-gap: 20px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Guest Room') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="post" action="{{url('guestroom')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="formdiv">
                        <div>
                            <x-label for="housename" value="{{ __('House Name') }}" />
                            <x-input id="housename" class="block mt-1 w-full" type="text" name="housename" :value="old('housename')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="roomcount" value="{{ __('No of Room') }}" />
                            <x-input id="roomcount" class="block mt-1 w-full" type="number" name="roomcount" :value="old('roomcount')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="minperiod" value="{{ __('Minimum Booking Period') }}" />
                            <x-input id="minperiod" class="block mt-1 w-full" type="number" name="minperiod" :value="old('minperiod')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="maxperiod" value="{{ __('Maximum Booking Period') }}" />
                            <x-input id="maxperiod" class="block mt-1 w-full" type="number" name="maxperiod" :value="old('maxperiod')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="rentperday" value="{{ __('Per Day Rent') }}" />
                            <x-input id="rentperday" class="block mt-1 w-full" type="number" name="rentperday" :value="old('rentperday')" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="photos" value="{{ __('Photos') }}" />
                            <input id="photos" class="block mt-1 w-full" type="file" name="photos[]" :value="old('photos')" multiple required >
                        </div>

                        <input name="name" value="{{auth()->user()->name}}" hidden>
                        <input name="mobileno" value="{{auth()->user()->mobileno}}" hidden>
                        <input name="email" value="{{auth()->user()->email}}" hidden>
                        <input name="address" value="{{auth()->user()->user_address}}" hidden>
                        <input name="district" value="{{auth()->user()->district}}" hidden>

                    </div>
                    <div class="flex items-center justify-center mt-4">
                        <x-button class="ms-4">
                            {{ __('Add Room') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>