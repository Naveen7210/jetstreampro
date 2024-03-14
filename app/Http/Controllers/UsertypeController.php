<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsertypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('houseowner.register');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('houseowner.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'mobileno' => ['required', 'string', 'max:10', 'min:10', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'user_address' => ['required', 'string', 'max:255'],
            'district' => ['required', 'string', 'max:255'],
            'password' => ['required','confirmed', Rules\Password::defaults()],
        ]);

        $usertype = 0;

        User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'mobileno' => $request['mobileno'],
            'user_address' => $request['user_address'],
            'district' => $request['district'],
            'user_type' => $usertype,
            'password' => Hash::make($request['password']),
        ]);

        return redirect('/dashboard');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
