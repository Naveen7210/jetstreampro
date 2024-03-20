<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Illuminate\Http\Request;
use App\Models\Roombookeddetails;

class RoombookingController extends Controller
{
    public function bookrooms(Request $request, string $id)
    {   

        $findhouse = guestrooms::where('id', '=', $id)->get();
        $findhouseid = guestrooms::where('id', '=', $id)->pluck('id')->first();
        for ($i = 0; $i < count($findhouse); $i++) {
            $monthcount = $findhouse[$i]->maxperiod;
            $dayamount = $findhouse[$i]->rentperday;
            $calamount = $request->selectedamount;
            $ownername = $findhouse[$i]->name;
            $owneraddress = $findhouse[$i]->address;
            $ownerhousename = $findhouse[$i]->housename;
            $ownermobileno = $findhouse[$i]->mobileno;
            $owneremail = $findhouse[$i]->email;

            if ($findhouse[$i]->status == 0) {
                $housebooked = 1;

                Roombookeddetails::create([
                    'houseid'=> $findhouseid,
                    'name'=> auth()->user()->name,
                    'mobileno'=> auth()->user()->mobileno,
                    'address'=> auth()->user()->user_address,
                    'housename'=> $ownerhousename,
                    'houseaddress'=> $owneraddress,
                    'maxdaycount'=> $monthcount,
                    'amountpaid'=> $calamount,
                    'amount'=> $calamount,
                    'status'=> 0,
                    'proof'=> 0,
                ]);

                $guestroom = guestrooms::find($id);
                $guestroom->status = $housebooked;
                $input = $request->all();
                $guestroom->update($input);



            } else {
                $message = "House is already booked";
                return redirect('/')->with('alert', $message);  
            }

        }

        $message = "Successfully House is booked for" . " " . $monthcount . " " . "days";
        return redirect('/')->with('success', $message);
    }
}
