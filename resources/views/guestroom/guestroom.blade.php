<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<x-app-layout>
    <x-slot name="header">
        <x-nav-link href="{{ route('guestroom.create') }}" :active="request()->routeIs('guestroom.create')">
            {{ __('Add Guest Room') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th>Name</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>House Count</th>
                            <th>Room Count</th>
                            <th>Min Period</th>
                            <th>Max Period</th>
                            <th>Per Day Rent</th>
                            <th>Photos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($guestrooms as $guest)
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$guest->name}}</td>
                            <td>{{$guest->mobileno}}</td>
                            <td>{{$guest->address}}</td>
                            <td>{{$guest->housecount}}</td>
                            <td>{{$guest->roomcount}}</td>
                            <td>{{$guest->minperiod}}</td>
                            <td>{{$guest->maxperiod}}</td>
                            <td>{{$guest->rentperday}}</td>
                            <td style="display: flex; width:fit-content; gap: 8px">@foreach($roomphotos as $roomphoto)
                                @if($guest->photos == $roomphoto->user_id )
                                <img src="{{$roomphoto->photos}}" width="100" height="100" id="fullscreen" style="border-radius: 5px;" onclick="fullscreen()">
                                @endif
                                @endforeach
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>