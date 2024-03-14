<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    form {
        margin: 3%;
    }

    .formdiv {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 20px;
        row-gap: 20px;
    }

    .imageupdate {
        display: flex;
        gap: 10px;
        justify-self: center;
        margin: 1%;
        width: 15%;
    }

    .imageupdate img{
        border-radius: 10px;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Update Room Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <form method="POST" action="{{url('guestroom/'.$editguestrooms->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="formdiv">
                        <div>
                            <x-label for="housename" value="{{ __('House Name') }}" />
                            <x-input id="housename" class="block mt-1 w-full" type="text" name="housename" value="{{$editguestrooms->housename}}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="roomcount" value="{{ __('No of Room') }}" />
                            <x-input id="roomcount" class="block mt-1 w-full" type="number" name="roomcount" value="{{$editguestrooms->roomcount}}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="minperiod" value="{{ __('Minimum Booking Period') }}" />
                            <x-input id="minperiod" class="block mt-1 w-full" type="number" name="minperiod" value="{{$editguestrooms->minperiod}}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="maxperiod" value="{{ __('Maximum Booking Period') }}" />
                            <x-input id="maxperiod" class="block mt-1 w-full" type="number" name="maxperiod" value="{{$editguestrooms->maxperiod}}" required autofocus autocomplete="name" />
                        </div>

                        <div>
                            <x-label for="photos" value="{{ __('Photos') }}" />
                            <input id="photos" class="block mt-1 w-full" type="file" name="photos[]" value="{{$editguestrooms->photos}}" multiple >
                        </div>

                        <div>
                            <x-label for="rentperday" value="{{ __('Per Day Rent') }}" />
                            <x-input id="rentperday" class="block mt-1 w-full" type="number" name="rentperday" value="{{$editguestrooms->rentperday}}" required autofocus autocomplete="name" />
                        </div>

                    </div>

                    <div class="imageupdate">
                        @foreach($roomphotos as $roompho)
                        <img src="{{$roompho->photos}}">
                        @endforeach
                    </div>

                    <div class="flex items-center justify-center mt-4">
                        <x-button class="ms-4">
                            {{ __('Update Room') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>