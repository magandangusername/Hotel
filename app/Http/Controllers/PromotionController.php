<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\promotion_description;
use Illuminate\Support\Facades\DB;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function promo()
    {

        //$promos = promotion_description::all();
        $date = date("Y-m-d h:i:sa");
        $promos = DB::table('promotion_descriptions')
        ->where('promotion_start', '<=', $date)
        ->where('promotion_end', '>=', $date)
        ->orderBy('created_at', 'DESC')
        ->get();
        //print_r($promos);
        return view('promo')->with('promos', $promos);

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
    public function show($name)
    {
        $content = promotion_description::where('promotion_name', '=', $name)->first();
        //$otherpromos = promotion_description::whereNotIn('promotion_name', $name)->limit(2);
        //dd($otherpromos);
        $first = promotion_description::whereNull('promotion_name');

        $otherpromos= promotion_description::where('promotion_name', '!=' , $name)
            ->inRandomOrder()
            ->limit(2)
            ->get();
        return view('promocontent')->with(compact('content', 'otherpromos', 'name'));

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
