<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Stripe;


class BookInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('bookinformation');
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
            'name_with_initials' => 'required',
            'fn' => 'required',
            'ln' => 'required',
            'email' => 'required',
            'address' => 'required',
            'city' => 'required',
            'mobilenum' => 'required'
        ]);

        $data = $request->input();
        // $title = $data['name_with_initials'];
        // $fn = $data['fn'];
        // $ln = $data['ln'];
        // $email = $data['email'];
        // $address = $data['address'];
        // $city = $data['city'];

        Session::put('title', $data['name_with_initials']);
        Session::put('fn', $data['fn']);
        Session::put('ln', $data['ln']);
        Session::put('email', $data['email']);
        Session::put('address', $data['address']);
        Session::put('city', $data['city']);

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 1170,
                "currency" => "php",
                "source" => $request->stripeToken,
                "description" => "Book down payment"
        ]);

        Session::flash('success', 'Payment successful!');

        // return back();

        return redirect('/bookinfo');


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
