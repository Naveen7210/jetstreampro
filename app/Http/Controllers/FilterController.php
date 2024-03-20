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


            $roomid = guestrooms::where('roomcount', '=', $minimum)->pluck('id');
            $livingvalue = guestrooms::where('roomcount', '=', $minimum)->pluck('roomcount');
            $mindayvalue = guestrooms::where('minday', '<=', $mindays)->pluck('minday');
            $maxdayvalue = guestrooms::where('maxperiod', '>=', $maxdays)->pluck('maxperiod');

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i])->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i])->first();
                    }
                }
            }

            $rooms1 = [];
            for ($i = 0; $i < count($livingvalue); $i++) {
                for ($j = 0; $j < count($mindayvalue); $j++) {
                    for ($k = 0; $k < count($maxdayvalue); $k++) {
                        $rooms1 = guestrooms::where('roomcount', '=', $livingvalue[$i])->where('minday', '>=', $mindayvalue[$j])->where('maxperiod', '>=', $maxdayvalue[$k])->get();
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

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i])->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i])->first();
                    }
                }
            }

            $rooms1 = [];
            for ($i = 0; $i < count($livingvalue); $i++) {
                $rooms1 = guestrooms::where('roomcount', '=', $livingvalue[$i])->get();
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

            $mindayvalue = guestrooms::where('minday', '<=', $mindays)->pluck('minday');

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i])->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i])->first();
                    }
                }
            }

            $rooms1 = [];
            for ($j = 0; $j < count($mindayvalue); $j++) {
                $rooms1 = guestrooms::where('minday', '>=', $mindayvalue[$j])->get();
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
                'maxday2' => ['required'],
            ]);
            $maxdays = $request->maxday2;

            $maxdayvalue = guestrooms::where('maxperiod', '>=', $maxdays)->pluck('maxperiod');

            $photorec1 = [];
            if (!(empty($roomid))) {
                for ($i = 0; $i < count($roomid); $i++) {
                    if (roomphotos::where('user_id', $roomid[$i])->exists()) {
                        $photorec1[] = roomphotos::where('user_id', '=', $roomid[$i])->first();
                    }
                }
            }

            $rooms1 = [];
            for ($k = 0; $k < count($maxdayvalue); $k++) {
                $rooms1 = guestrooms::where('maxperiod', '>=', $maxdayvalue[$k])->get();
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
                $message = "Sorry No house is available with" . " " . $maxdayvalue . " " . "Maximum day, if its available we will contact you";
                return redirect('/')->with('alert', $message);
            }
        }
    }
}
