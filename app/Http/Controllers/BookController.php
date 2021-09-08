<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('booking');
    }
    public function book()
    {
        //
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date1 = date("Y-m-d", strtotime('now'));
        $date2 = date("Y-m-d", strtotime('now'.'+ 1 days'));

        $message = "validation failed";
        $request->validate([
            'CheckIn' => "required|date|after:".$date1,
            // 'CheckOut' => 'required|date|min:'.$date2,
            // 'roomcount' => 'required|integer|min:1|max:3',
            'guestcount' => 'required|integer|min:1',
            // 'guestcountchild' => 'required|integer|min:0',
            // 'guestcount2' => 'required|integer|min:1',
            // 'guestcountchild2' => 'required|integer|min:0',
            // 'guestcount3' => 'required|integer|min:1',
            // 'guestcountchild3' => 'required|integer|min:0'

        ]);

        // $data = $request->input();
        // $request->session()->put($data);
        //echo session('guestcount');
        dd($date2);
        $message = "validation successful!";

        return redirect('/book');
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
