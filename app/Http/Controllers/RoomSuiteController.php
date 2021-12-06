<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room_description;
use App\Models\suite_description;
use App\Models\gallery_photos;
use Illuminate\Support\Facades\Auth;

class RoomSuiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function rooms()
    {


        $rooms = room_description::get();
        return view('roomtab')->with(compact('rooms'));
    }

    public function suites()
    {
        if(Auth::check() && !Auth::user()->verified) {

            return redirect('/email/verify');
        }
        $suites = suite_description::get();
        return view('suitestab')->with(compact('suites'));
    }

    public function roominfo($name)
    {
        $roominfo = room_description::join('amenities as am', 'room_descriptions.amenities_number', '=', 'am.amenities_number')->where('room_descriptions.room_name', '=', $name)->first();

        if(!isset($roominfo)){
            $roominfo = suite_description::join('amenities as am', 'suite_descriptions.amenities_number', '=', 'am.amenities_number')->where('suite_descriptions.suite_name', '=', $name)->first();
        }

        $photos = gallery_photos::join('gallery_albums as a', 'gallery_photos.album_id', '=', 'a.album_id')->where('a.album_name', '=', $name)->get();
        return view('roomsuiteinfo')->with(compact('roominfo', 'photos'));
    }

    public function suiteinfo($name)
    {
        $roominfo = suite_description::join('amenities as am', 'suite_descriptions.amenities_number', '=', 'am.amenities_number')->where('suite_descriptions.suite_name', '=', $name)->first();
        $photos = gallery_photos::join('gallery_albums as a', 'gallery_photos.album_id', '=', 'a.album_id')->where('a.album_name', '=', $name)->get();

        return view('roomsuiteinfo')->with(compact('roominfo', 'photos'));
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
