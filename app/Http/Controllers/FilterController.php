<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function amountfilters(Request $request){

        $request->validate([
            'minamount' => ['required'],
            'minday' => ['required'],
            'maxday' => ['required'],
        ]);

        $minimum = $request->minamount;
        $mindays = $request->minday;
        $maxdays = $request->maxday;

        //$rooms = guestrooms::where('roomcount','=',$minimum)->get();
        $roomid = guestrooms::where('roomcount','=',$minimum)->pluck('id');
        $livingvalue = guestrooms::where('roomcount','=',$minimum)->pluck('roomcount');
        $mindayvalue = guestrooms::where('minday','=',$mindays)->pluck('minday');
        $maxdayvalue = guestrooms::where('maxperiod','=',$maxdays)->pluck('maxperiod');

        $photorec1 = [];
        if(!(empty($roomid))){
            for($i=0;$i<count($roomid);$i++){
                if(roomphotos::where('user_id',$roomid[$i])->exists()){
                    $photorec1[]= roomphotos::where('user_id','=',$roomid[$i])->first();
                }
            }
        }   
        
        $rooms = [];
        for($i=0;$i<count($livingvalue);$i++){
            for($j=0;$j<count($mindayvalue);$j++){
                for($k=0;$k<count($maxdayvalue);$k++){
                    $rooms = guestrooms::where('roomcount','=',$livingvalue[$i])->where('minday','=',$mindayvalue[$j])->where('maxperiod','=',$maxdayvalue[$k])->get();
                }
            }
        }

        if(!(empty($photorec1) || (empty($rooms)))){
            return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec1);
        }else{            
            $message = "Sorry No house is available with". " " . $minimum . " " . "rooms, if its available we will contact you";
            return redirect('/')->with('alert', $message);
        }
        
    }
}
