<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .detailviewmaindiv {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        margin: 0 15% 0 15%;
    }

    .detailheadingview {
        display: flex;
        background-color: orange;
        border-radius: 8px 8px 0 0;
    }

    .viewheading {
        width: 80%;
        padding: 1% 1% 1% 2%;
        font-weight: 700;
        font-size: 25px;
        color: crimson;
    }

    .viewedit {
        padding: 1%;
        font-size: 28px;
        width: 10%;
    }

    .formdelete {
        width: 10%;
        margin: 1%;
    }

    .deleteview {
        font-size: 28px;
    }

    .detailsubview {
        display: flex;
        background-color: white;
        border-radius: 0 0 8px 8px;
        border-width: 2px;
        border-color: orange;
        padding: 0 0 0 0;
    }

    .detailflex1view {
        width: 35%;
    }

    .detailflex2view {
        width: 65%;
    }

    .viewfield {
        height: 5vh;
        padding: 2.5% 0 0 5%;
        border-width: 0 2px 1px 0;
        border-color: transparent orange black transparent;
        font-weight: 700;
    }

    .viewfield1 {
        height: fit-content;
        padding: 2.5% 0 0 5%;
        border-width: 0 2px 0 0;
        border-color: transparent;
        font-weight: 700;
    }

    .viewvalue {
        height: 5vh;
        padding: 2.5% 0 0 1%;
        border-width: 0 0 1px 0;
        border-color: transparent transparent black transparent;
        font-weight: 700;
    }

    .viewvalue1 {
        height: fit-content;
        padding: 2.5%;
        border-width: 0 0 0 2px;
        margin-left: -2px;
        border-color: transparent transparent transparent orange;
        font-weight: 700;
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        column-gap: 10px;
        row-gap: 5px;
        width: fit-content;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Details View') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden">
                <div class="detailviewmaindiv">
                    <div class="detailheadingview">
                        <h2 class="viewheading">{{$guestroomview->housename}}</h2>
                        <a class="viewedit" href="{{url('/guestroom/'.$guestroomview->id.'/edit')}}"><i class="fa-solid fa-pen-to-square"></i></a>
                        <form method="post" action="{{url('/guestroom/'.$guestroomview->id)}}" class="formdelete">
                            @csrf
                            @method('Delete')
                            <button class="deleteview"><i class="fa-solid fa-trash-can-arrow-up"></i></button>
                        </form>
                    </div>
                    <div class="detailsubview">
                        <div class="detailflex1view">
                            <h4 class="viewfield">House Address</h4>
                            <h4 class="viewfield">Count of Rooms</h4>
                            <h4 class="viewfield">Minimum Day Count</h4>
                            <h4 class="viewfield">Maximum Day Count</h4>
                            <h4 class="viewfield">Rent Per Day</h4>
                            <h4 class="viewfield1">Room Photos</h4>
                        </div>
                        <div class="detailflex2view">
                            <h5 class="viewvalue">{{$guestroomview->address}}</h5>
                            <h5 class="viewvalue">{{$guestroomview->roomcount}}</h5>
                            <h5 class="viewvalue">{{$guestroomview->minperiod}}</h5>
                            <h5 class="viewvalue">{{$guestroomview->maxperiod}}</h5>
                            <h5 class="viewvalue">{{$guestroomview->rentperday}}</h5>
                            <h5 class="viewvalue1">
                                @foreach($roomphotos as $roomph)
                                @if($guestroomview->photos == $roomph->user_id)
                                <img src="{{$roomph->photos}}" style="border-radius: 5px;">
                                @endif
                                @endforeach
                            </h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>