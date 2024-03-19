<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;

class RoombookingController extends Controller
{
    public function bookrooms(Request $request, string $id)
    {

        $findhouse = guestrooms::where('id', '=', $id)->get();
        for ($i = 0; $i < count($findhouse); $i++) {
            $monthcount = $findhouse[$i]->maxperiod;
            $dayamount = $findhouse[$i]->rentperday;
            $calamount = $monthcount *  $dayamount;
            $owner = $findhouse[$i]->name;
            $owner = $findhouse[$i]->address;
            $owner = $findhouse[$i]->housename;
            $owner = $findhouse[$i]->mobileno;
            $owner = $findhouse[$i]->email;

            if ($findhouse[$i]->status == 0) {
                $housebooked = 1;
            } else {
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);
            }

            $guestroom = guestrooms::find($id);
            $guestroom->status = $housebooked;
            $input = $request->all();
            $guestroom->update($input);
        }

        $message = "Successfully House is booked for" . " " . $monthcount . " " . "days";
        return redirect('/')->with('success', $message);
    }
}
