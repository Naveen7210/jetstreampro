<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .rentalroomviews{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        column-gap: 20px;
        row-gap: 10px;
    }

    .grouprentalroom{
        padding: 5%;
        border-radius: 10px;
        background-color:tan;
    }

    .imageviews{
        border-radius: 10px;
        width: 100%;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <x-nav-link href="{{ route('guestroom.create') }}" :active="request()->routeIs('guestroom.create')">
            {{ __('Add Guest Room') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table table-striped" width="100%">
                    <thead>
                        <tr>
                            <th>Sl No</th>
                            <th hidden>Name</th>
                            <th hidden>Mobile</th>
                            <th hidden>Address</th>
                            <th>House Name</th>
                            <th hidden>No of Rooms</th>
                            <th>Min Day</th>
                            <th>Max Day</th>
                            <th>Per Day Rent</th>
                            <th hidden>Photos</th>
                            <th>Details</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($guestrooms as $guest)
                        <tr>
                            <td>{{$i}}</td>
                            <td hidden>{{$guest->name}}</td>
                            <td hidden>{{$guest->mobileno}}</td>
                            <td hidden>{{$guest->address}}</td>
                            <td>{{$guest->housename}}</td>
                            <td hidden>{{$guest->roomcount}}</td>
                            <td>{{$guest->minperiod}}</td>
                            <td>{{$guest->maxperiod}}</td>
                            <td>{{$guest->rentperday}}</td>
                            <td hidden style="display: flex; width:fit-content; gap: 8px">@foreach($roomphotos as $roomphoto)
                                @if($guest->photos == $roomphoto->user_id )
                                <img src="{{$roomphoto->photos}}" width="100" height="100" id="fullscreen" style="border-radius: 5px;" onclick="fullscreen()">
                                @endif
                                @endforeach
                            </td>
                            <td><a href="{{url('/guestroom/'.$guest->id)}}"><i class="fa-solid fa-eye"></i></a></td>
                            <td><a href="{{url('/guestroom/'.$guest->id.'/edit')}}"><i class="fa-solid fa-pen-to-square"></i></a></td>
                            <td>
                                <form method="post" action="{{url('/guestroom/'.$guest->id)}}">
                                    @csrf
                                    @method('Delete')
                                    <button><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                        @endforeach
                    </tbody>
                </table>
                <!-- <div class="rentalroomviews">
                    @foreach($guestrooms as $guestrom)
                    @foreach($roomphotos as $roomphot)
                    @if($guestrom->id == $roomphot->user_id && auth()->user()->mobileno == $guestrom->mobileno)
                    <div class="grouprentalroom">
                        <img src="{{$roomphot->photos}}" class="imageviews">
                        {{$guestrom->housename}}
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </div> -->
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>