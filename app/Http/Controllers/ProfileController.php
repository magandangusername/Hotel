<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use CardDetect;
use Stripe;

class ProfileController extends Controller
{
    public function userprofile()
    {
        if(Auth::check()) {
            // dd(Auth::user()->first_name);
            $profile = DB::table('users')
            ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
            ->where('users.id', Auth::user()->id)
            ->first();

            $active_reservation = DB::table('users')
            ->leftJoin('reservation_tables', 'reservation_tables.user_id', '=', 'users.id')
            ->where('reservation_tables.departure_date', '>', date('Y-m-d'))
            ->count();


            return view('userprofile')->with(compact('profile','active_reservation'));

        }

        return redirect('/login');

    }

    public function updateprofile(Request $request)
    {
        $profile = DB::table('users')
            ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
            ->where('users.id', Auth::user()->id)
            ->first();
        $active_reservation = DB::table('users')
        ->leftJoin('reservation_tables', 'reservation_tables.user_id', '=', 'users.id')
        ->where('reservation_tables.departure_date', '<', date('Y-m-d'))
        ->count();
        if ($request->input('editprofile') == 'editprofile') {
            $update = true;
            return view('userprofile')->with(compact('update','profile', 'active_reservation'));
        }
        if ($request->input('updateprofile') == 'updateprofile') {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'mobile_num' => 'required',
                'address' => 'required'
            ]);

            $updateprofile = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update([
                'first_name' => $request->input('first_name'),
                'last_name' => $request->input('last_name'),
                'email' => $request->input('email'),
                'mobile_num' => $request->input('mobile_num'),
                'address' => $request->input('address')
            ]);

            return redirect('/userprofile');
        }




        if ($request->input('editpayment') == 'editpayment') {
            $updatepayment = true;
            return view('userprofile')->with(compact('updatepayment','profile', 'active_reservation'));
        }
        if ($request->input('updatepayment') == 'updatepayment') {
            // $request->validate([
            //     'card_holder_name' => 'required',
            //     // 'payment_type' => 'required',
            //     'card_number' => 'required',
            //     'cvc' => 'required',
            //     'expiration_month' => 'required',
            //     'expiration_year' => 'required'
            // ]);

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = Stripe\Charge::create ([
                "amount" => 50.00 * 100,
                "currency" => "php",
                "source" => $request->stripeToken,
                "description" => "card validate"
            ]);

            $re = \Stripe\Refund::create([
                "charge" => $charge->id
            ]);

            $customer = \Stripe\Customer::create([
                'source' => 'tok_mastercard',
                'email' => Auth::user()->email,
            ]);

            $charge = \Stripe\Charge::create([
                'amount' => 50.00 * 100,
                'currency' => 'php',
                'customer' => $customer->id,
            ]);

            $detector = new CardDetect\Detector();
            $card = str_replace(' ', '', $request->input('card_number'));
            $cardtype = $detector->detect($card);


            $updateprofile = DB::table('users')
            ->leftJoin('payment_informations', 'payment_informations.payment_code', '=', 'users.payment_code')
            ->where('id', Auth::user()->id)
            ->update([
                'payment_informations.card_holder_name' => $request->input('card_holder_name'),
                'payment_informations.payment_type' => $cardtype,
                'payment_informations.card_number' => $request->input('card_number'),
                'payment_informations.cvc' => $request->input('cvc'),
                'payment_informations.expiration_month' => $request->input('expiration_month'),
                'payment_informations.expiration_year' => $request->input('expiration_year')
            ]);

            return redirect('/userprofile');
        }


        if ($request->input('addpayment') == 'addpayment') {
            $addpayment = true;
            return view('userprofile')->with(compact('addpayment','profile', 'active_reservation'));
        }
        if ($request->input('submitpayment') == 'submitpayment') {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = \Stripe\Customer::create([
                'source' => 'tok_mastercard',
                'email' => Auth::user()->email,
            ]);

            $charge = \Stripe\Charge::create([
                'amount' => 50.00 * 100,
                'currency' => 'php',
                'customer' => $customer->id,
            ]);

            $re = \Stripe\Refund::create([
                "charge" => $charge->id
            ]);

            // $charge = Stripe\Charge::create ([
            //     "amount" => 50.00 * 100,
            //     "currency" => "php",
            //     "source" => $request->stripeToken,
            //     "description" => "card validate"
            // ]);

            // $re = \Stripe\Refund::create([
            //     "charge" => $charge->id
            // ]);

            $payment = DB::table('payment_informations')->count();
            $payment = 'PC-0'.($payment + 1);

            $detector = new CardDetect\Detector();
            $cardtype = $detector->detect($request->input('card_number'));

            $paymentinfo = DB::table('payment_informations')->insert([
                'payment_code' => $payment,
                'payment_type' => $cardtype,
                'card_number' => $request->input('card_number'),
                'card_holder_name' => $request->input('card_holder_name'),
                'expiration_month' => $request->input('expiration_month'),
                'expiration_year' => $request->input('expiration_year'),
                'cvc' => $request->input('cvc'),
                'charge_id' => $charge->id,
                'customer_id' => $customer->id

            ]);

            $user = DB::table('users')
            ->where('id', Auth::user()->id)
            ->update(['payment_code' => $payment]);

            return redirect('/userprofile');
        }

    }
}
