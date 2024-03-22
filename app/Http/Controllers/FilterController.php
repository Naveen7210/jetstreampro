<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function alltypefilters(Request $request)
    {

        $types = $request->typeoffilter;


        if ($types == 'allfilter') {

            $minimum = $request->minamount;
            $mindays = $request->minday;
            $maxdays = $request->maxday;

            $roomid = guestrooms::where('roomcount', '=', $minimum)->get();

            $rooms1 = [];
            for($i=0;$i<count($roomid);$i++){
                $rooms1 = guestrooms::where('roomcount', '=', $roomid[$i]->roomcount)->where('minday', '<=', $roomid[$i]->minday)->where('maxperiod', '>=', $roomid[$i]->maxperiod)->get();
            }
            
            $photorec1 = [];
            if (!(empty($rooms1))) {
                for ($i = 0; $i < count($rooms1); $i++) {
                    if (roomphotos::where('user_id', $rooms1[$i]->id)->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $rooms1[$i]->id)->first();
                    }
                }
            }

            $rooms = [];
            for ($i = 0; $i < count($rooms1); $i++) {
                $checkstatus = $rooms1[$i]->status;
                if ($checkstatus == 0) {
                    $rooms [] = $rooms1[$i];
                }
            }

            if(empty($rooms)){
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);
            }

            if (!(empty($photorec1) || (empty($rooms)))) {
                return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec1);
            } else {
                $message = "Sorry No house is available with" . " " . $minimum . " " . "living rooms, if its available we will contact you";
                return redirect('/')->with('alert', $message);
            }
        } elseif ($types == 'livingroom') {

            $request->validate([    
                'minamount1' => ['required'],
            ]);

            $minimum = $request->minamount1;

            $roomid = guestrooms::where('roomcount', '=', $minimum)->pluck('id');
            $livingvalue = guestrooms::where('roomcount', '=', $minimum)->pluck('roomcount');

            $rooms1 = [];
            for ($i = 0; $i < count($livingvalue); $i++) {
                $rooms1 = guestrooms::where('roomcount', '=', $livingvalue[$i])->get();
            }
            
            $photorec1 = [];
            if (!(empty($rooms1))) {
                for ($i = 0; $i < count($rooms1); $i++) {
                    if (roomphotos::where('user_id', $rooms1[$i]->id)->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $rooms1[$i]->id)->first();
                    }
                }
            }
            
            $rooms = [];
            for ($i = 0; $i < count($rooms1); $i++) {
                $checkstatus = $rooms1[$i]->status;
                if ($checkstatus == 0) {
                    $rooms [] = $rooms1[$i];
                }
            }

            if(empty($rooms)){
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);
            }
            
            if (!(empty($photorec1) || (empty($rooms)))) {
                return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec1);
            } else {
                $message = "Sorry No house is available with" . " " . $minimum . " " . "living rooms, if its available we will contact you";
                return redirect('/')->with('alert', $message);
            }
        } elseif ($types == 'minroomcount') {

            $request->validate([
                'minday1' => ['required'],
            ]);

            $mindays = $request->minday1;

            $roomid = guestrooms::where('minday', '<=', $mindays)->where('maxperiod', '>=', $mindays)->get();

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i]->id)->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i]->id)->first();
                    }
                }
            }

            $rooms1 = [];
            for ($j = 0; $j < count($roomid); $j++) {
                $rooms1 = guestrooms::where('minday', '<=', $roomid[$j]->minday)->where('maxperiod', '>=', $roomid[$j]->maxperiod)->get();
            }

            $rooms = [];
            for ($i = 0; $i < count($rooms1); $i++) {
                $checkstatus = $rooms1[$i]->status;
                if ($checkstatus == 0) {
                    $rooms [] = $rooms1[$i];
                }
            }

            if(empty($rooms)){
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);
            }

            if (!(empty($photorec1) || (empty($rooms)))) {
                return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec1);
            } else {
                $message = "Sorry No house is available with" . " " . $mindays . " " . "Minimum day, if its available we will contact you";
                return redirect('/')->with('alert', $message);
            }
        } elseif ($types == 'maxroomcount') {

            $request->validate([
                'maxday1' => ['required'],
            ]);
            $maxdays = $request->maxday1;

            $roomid = guestrooms::where('minday', '<=', $maxdays)->where('maxperiod', '>=', $maxdays)->get();

            //return $roomid;

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i]->id)->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i]->id)->first();
                    }
                }
            }
            //return $photorec1;

            $rooms1 = [];
            for ($k = 0; $k < count($roomid); $k++) {
                $rooms1 = guestrooms::where('maxperiod', '>=', $roomid[$k]->maxperiod)->where('minday', '>=', $roomid[$k]->minday)->get();
            }
            //return $rooms1;
            $rooms = [];
            for ($i = 0; $i < count($rooms1); $i++) {
                $checkstatus = $rooms1[$i]->status;
                if ($checkstatus == 0) {
                    $rooms [] = $rooms1[$i];
                }
            }
            //return $rooms;
            if(empty($rooms)){
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);
            }

            if (!(empty($photorec1) || (empty($rooms)))) {
                return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec1);
            } else {
                $message = "Sorry No house is available with" . " " . $maxdays . " " . "Maximum day, if its available we will contact you";
                return redirect('/')->with('alert', $message);
            }
        }
    }
}
