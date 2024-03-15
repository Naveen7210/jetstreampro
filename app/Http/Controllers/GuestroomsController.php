<?php

namespace App\Http\Controllers;

use App\Models\guestrooms;
use App\Models\User;
use App\Models\roomphotos;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;

class GuestroomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guestrooms = guestrooms::get();
        $roomphotos = roomphotos::get();
        return view('guestroom.guestroom')->with('guestrooms', $guestrooms)->with('roomphotos', $roomphotos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guestroom.addguestroom');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'max:255'],
            'mobileno' => ['required', 'max:10', 'min:10'],
            'email' => ['required', 'email'],
            'address' => ['required', 'max:255'],
            'district' => ['required', 'max:255'],
            'housename' => ['required'],
            'roomcount' => ['required'],
            'minperiod' => ['required'],
            'maxperiod' => ['required'],
            'rentperday' => ['required'],
        ]);

        $photoid = guestrooms::orderBy('id', 'DESC')->pluck('id')->first();
        $photosid = $photoid +  1;
        foreach ($request->file('photos') as $photo) {
            $filename = time() . $photo->getClientOriginalName();
            $path = $photo->storeAs('images', $filename, 'public');
            $requestData["photos"] = '/storage/' . $path;
            roomphotos::create([
                'photos' => $requestData["photos"],
                'user_id' => $photosid,
            ]);
        }

        guestrooms::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobileno' => $request['mobileno'],
            'address' => $request['address'],
            'district' => $request['district'],
            'housename' => $request['housename'],
            'roomcount' => $request['roomcount'],
            'minperiod' => $request['minperiod'],
            'maxperiod' => $request['maxperiod'],
            'rentperday' => $request['rentperday'],
            'photos' => $photosid,
        ]);
        return redirect('/guestroom');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $id)
    {
        $guestroomview = guestrooms::find($id);
        $roomphotos = roomphotos::get();
        return view('guestroom.viewguestroom')->with('guestroomview', $guestroomview)->with('roomphotos', $roomphotos);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $editguestrooms = guestrooms::find($id);
        $roomphotos = roomphotos::where('user_id', '=', $editguestrooms->id)->get();
        return view('guestroom.editguestroom')->with('editguestrooms', $editguestrooms)->with('roomphotos', $roomphotos);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $guestroom = guestrooms::find($id);
        $input = $request->all();
        $guestroom->update($input);

        return redirect('/guestroom');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        guestrooms::destroy($id);
        return redirect('/guestroom');
    }

    public function viewrentalroom()
    {

        $rentalrooms = guestrooms::get();
        $roomphotoss = roomphotos::get();
        $rentalroomid = guestrooms::pluck('id');
        $userids = roomphotos::pluck('user_id');
        $photos = roomphotos::pluck('photos');
        
        $firstids = array();
        $j = 0;
        for ($i = 0; $i < count($rentalroomid); $i++) {
            for ($k = 0; $k < count($userids); $k++) {
                if ($rentalroomid[$i] == $userids[$k]) {
                    if (!(in_array($userids[$k], $firstids))) {
                        $firstids[] = $userids[$k];
                    }
                }
            }
            $j++;
        }

        $photorec = [];
        $l = 0;
        for ($i = 0; $i < count($firstids); $i++) {
            for ($j = 0; $j < count($roomphotoss); $j++) {
                if ($firstids[$i] == $roomphotoss[$j]->user_id) {
                    $photorec[$l] = $roomphotoss[$j];
                }
            }
            $l++;
        }

        $rooms = [];
        $o = 0;
        for ($i = 0; $i < count($rentalrooms); $i++) {
            for ($j = 0; $j < count($firstids); $j++) {
                if ($firstids[$j] == $rentalrooms[$i]->id) {
                    $rooms[] = $rentalrooms[$i];
                }
            }
            $o++;
        }

        return view('rental-room.rental-room')->with('rooms', $rooms)->with('photorec', $photorec);;
    }
}
