<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function checkusers(){

        if(empty(auth()->user()->name)){
            return redirect('/login');
        }elseif(!(empty(auth()->user()->name))){
            return redirect('/guestroom');
        }

        
    }

    public function view_details(string $id){
        
        $viewrooms = guestrooms::find($id);
        $photoc = roomphotos::where('user_id','=',$id)->get();
        return view('rental-room.detailview')->with('viewrooms', $viewrooms)->with('photoc', $photoc);
    }
}
