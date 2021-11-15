<?php

namespace App\Http\Controllers;
use App\Models\room_status;
use App\Models\promotion_description;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = date("Y-m-d h:i:sa");
        $roomtype = room_status::distinct('room_suite_name')->limit(3)->get();
        $promos = promotion_description::where('promotion_start', '<=', $date)->where('promotion_end', '>=', $date)->limit(3)->get();

        $newpromos = DB::table('promotion_descriptions')
        ->orderByRaw('promotion_start DESC')
        ->where('promotion_start', '<=', $date)
        ->where('promotion_end', '>=', $date)
        ->get();

        return view('index')->with(compact('roomtype','promos','newpromos'));
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
