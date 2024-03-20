<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function checkusers()
    {

        if (empty(auth()->user()->name)) {
            return redirect('/login');
        } elseif (!(empty(auth()->user()->name))) {
            return redirect('/guestroom');
        }
    }

    public function view_details(string $id)
    {

        $findhouse = guestrooms::where('id', '=', $id)->get();

        for ($i = 0; $i < count($findhouse); $i++) {
            if ($findhouse[$i]->status == 0) {
                $viewrooms = guestrooms::find($id);
                $photoc = roomphotos::where('user_id', '=', $id)->get();
                return view('rental-room.detailview')->with('viewrooms', $viewrooms)->with('photoc', $photoc);
            }else{
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);  
            }
        }
    }
}
