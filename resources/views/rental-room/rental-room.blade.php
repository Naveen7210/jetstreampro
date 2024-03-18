<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .rentalroommaindiv {
        width: 100%;
        display: flex;
        gap: 2%;
    }

    .flexmaindiv {
        width: 20%;
    }

    .rentalroomviews {
        display: grid;
        width: 80%;
        grid-template-columns: repeat(1, 1fr);
        column-gap: 20px;
        row-gap: 30px;
    }

    .grouprentalroom {
        display: flex;
        padding: 2%;
        background-color: white;
    }

    .imagediv {
        width: 30%;
    }

    .mainimg {
        width: 100%;
        position: relative;
    }

    .imageviews {
        border-radius: 10px;
        width: 100%;
    }

    .contentdiv {
        width: 70%;
        display: flex;
        padding: 0 2% 0 2%;
    }

    .contentflex1div {
        display: flex;
        width: 70%;
    }

    .contentflex2div {
        width: 30%;
        padding: 2% 0 0 0;
        background-color: white;
    }

    .flex1divcontent {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        row-gap: 20p;
        width: 50%;
    }

    .fleximgcontent {
        display: flex;
        height: 10vh;
        padding: 0 0 0 5%;
    }

    .image {
        width: 30%;
        padding: 5% 0 0 6%;

    }

    .content {
        width: 70%;
        padding: 10% 0 0 1%;
    }

    .contentgrid {
        width: 70%;
        padding: 4% 0 0 1%;
    }

    .imageicon {
        width: 70%;
    }

    .contentname {
        font-size: 20px;
        text-align: left;
    }

    .contentcount {
        font-size: 20px;
        font-weight: 700;
        text-align: left;
        padding: 4% 0 0 0;
    }

    .name {
        padding: 3%;
    }

    .houename {
        font-size: 22px;
        text-align: center;
    }

    .buttondiv {
        display: flex;
        height: 7vh;
        background-color: white;
        box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        padding: 5% 5% 5% 13%;
    }

    .buttondiv1 {
        display: flex;
        height: 7vh;
        margin: 10% 0 0 0;
        justify-content: center;
        background-color: white;
        box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
        padding: 7% 0 0 0;
    }

    .amount {
        font-size: 22px;
        font-weight: 800;
        padding: 0 0 0 10%;
    }

    .amounttype {
        font-size: 14px;
        padding: 1.5% 0 0 0;
    }

    .rupeeimg {
        padding: 0 0 0 0;
    }

    .viewdiv{
        font-size: 20px;
        font-weight: 800;
    }
</style>
<x-guestroom-layout>
    <x-slot name="header">
        <x-nav-link>
            {{ __('Rental Rooms') }}
        </x-nav-link>
    </x-slot>

    <div class="py-12" onload="functions()">
        <div class=" mx-auto sm:px-6 lg:px-4">
            <div class="overflow-hidden ">
                <div class="rentalroommaindiv">
                    <div class="flexmaindiv">

                    </div>
                    <div class="rentalroomviews">
                        @foreach($rooms as $rooms)                        
                        @foreach($photorec as $photoc)
                        @if($rooms->id == $photoc->user_id)
                        <div class="grouprentalroom sm:rounded-lg">
                            <div class="imagediv">
                                <div class="mainimg">
                                    <img src="{{$photoc->photos}}" class="imageviews">
                                </div>
                                <div class="name">
                                    <h3 class="houename">{{$rooms->address}}</h3>
                                </div>
                            </div>
                            <div class="contentdiv">
                                <div class="contentflex1div">
                                    <div class="flex1divcontent">
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/house.png')}}" class="imageicon">
                                            </div>
                                            <div class="content">
                                                <h4 class="contentname">Rental House</h4>
                                            </div>
                                        </div>
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/living.png')}}" class="imageicon">
                                            </div>
                                            <div class="contentgrid">
                                                <h4 class="contentname">Living Room</h4>
                                                <h4 class="contentcount">{{$rooms->roomcount}}</h4>
                                            </div>
                                        </div>
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/beds.png')}}" class="imageicon">
                                            </div>
                                            <div class="contentgrid">
                                                <h4 class="contentname">Bed Room</h4>
                                                <h4 class="contentcount">{{$rooms->roomcount}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex1divcontent">
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/bath.png')}}" class="imageicon">
                                            </div>
                                            <div class="contentgrid">
                                                <h4 class="contentname">Bath Room</h4>
                                                <h4 class="contentcount">{{$rooms->roomcount}}</h4>
                                            </div>
                                        </div>
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/sortdec.png')}}" class="imageicon">
                                            </div>
                                            <div class="contentgrid">
                                                <h4 class="contentname">Minimum Day</h4>
                                                <h4 class="contentcount">{{$rooms->minperiod}}</h4>
                                            </div>
                                        </div>
                                        <div class="fleximgcontent">
                                            <div class="image">
                                                <img src="{{url('/storage/customimages/sortinc.png')}}" class="imageicon">
                                            </div>
                                            <div class="contentgrid">
                                                <h4 class="contentname" id="maxday">Maximum Day</h4>
                                                <h4 class="contentcount">{{$rooms->maxperiod}}</h4>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="contentflex2div">
                                    <div class="buttondiv sm:rounded-lg">
                                        <img src="{{url('/storage/customimages/rupee.png')}}" class="rupeeimg">
                                        <a class="amount" id="maxamt">{{$rooms->rentperday}}/</a>
                                        <a class="amounttype">Per Day</a>
                                    </div>
                                    <div class="buttondiv1 sm:rounded-lg">
                                        <h3 class="viewdiv">View Details</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guestroom-layout>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

<script>
    function functions(){
        let maximumday = document.getElementById('')
    }
</script>