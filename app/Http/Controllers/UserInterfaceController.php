<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UserInterfaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $roles = $user->roles;
        return view ('user.index')->withUser($user)->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($id == Auth::user()->id) {
            if ($request->user()->name == Auth::user()->name) {
                $this->validate($request, [
                    'street'        => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'streetnr'      => 'nullable|integer|regex:/[0-9]+/',
                    'city'          => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'province'      => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'country'       => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'telephone1'    => 'nullable|regex:/[0-9\-]+/',
                    'telephone2'    => 'nullable|regex:/[0-9\-]+/',
                ]);
            } else {
                $this->validate($request, [
                    'name'          => 'required|string|unique:users|min:2|regex:/[ a-zA-Z0-9]+/',
                    'street'        => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'streetnr'      => 'nullable|integer|regex:/[0-9]+/',
                    'city'          => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'province'      => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'country'       => 'nullable|string|min:2|regex:/[ a-zA-Z]+/',
                    'telephone1'    => 'nullable|regex:/[0-9\-]+/',
                    'telephone2'    => 'nullable|regex:/[0-9\-]+/',
                ]);
            }
            
            $user = Auth::user();
            $user->name         = $request->name;
            $user->street       = $request->street;
            $user->streetnr     = $request->streetnr;
            $user->city         = $request->city;
            $user->province     = $request->province;
            $user->country      = $request->country;
            $user->telephone1   = $request->telephone1;
            $user->telephone2   = $request->telephone2;

            $user->save();
            return ["message"=>"Gebruiker opgeslagen!"];

        } else {

            return ["message"=>"authentication userID does not match client submitted user id"];

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
