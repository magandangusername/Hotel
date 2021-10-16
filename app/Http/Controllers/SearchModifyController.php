<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchModifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('search');
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
        $request->validate([
            'confirmation_number' => 'required|integer',
            'email' => 'required'
        ]);

        $data = $request->input();

        $user = DB::table('users')->where('email', $data['email'])->first();

        $id = '';
        if ($user != null) {
            $id = $user->id;
        } else {
            $guest = DB::table('guest_informations')->where('email', $data['email'])->first();
            if ($guest != null) {
                $id = $guest->guest_code;
            }
        }



        $book = DB::table('reservation_tables')->where('confirmation_number', $data['confirmation_number'])->where('user_id', $id)->orWhere('guest_code', $id)->count();




        // $gbook = DB::table('reservation_tables')->where('guest_code', $gid)->where('confirmation_number', $data['confirmation_number'])->count();
        if ($book >= 1) {
            Session::put('confirmation_number', $data['confirmation_number']);
            Session::put('uid', $id);

            return redirect('modify');
            dd('congrats');

        } else {
            // dd('BOBO mo! wala kang kwenta! di ka mahal ng nanay mo! lampa! inutil! hampas lupa! wag ka na magcode! maggenshin ka nalang! wala kang future! para kang si skye!');

            dd('INVALID CONFIRMATION OR EMAIL');
        }
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
        //
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
