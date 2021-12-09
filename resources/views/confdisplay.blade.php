@if (session()->exists('confirmation_number'))
<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
    html,
    body,
    table,
    tbody,
    tr,
    td,
    div,
    p,
    ul,
    ol,
    li,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        margin: 0;
        padding: 0;
    }

    body {
        margin: 0;
        padding: 0;
        font-size: 0;
        line-height: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    table {
        border-spacing: 0;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
    }

    table td {
        border-collapse: collapse;
    }

    .ExternalClass {
        width: 100%;
    }

    .ExternalClass,
    .ExternalClass p,
    .ExternalClass span,
    .ExternalClass font,
    .ExternalClass td,
    .ExternalClass div {
        line-height: 100%;
    }

    /* Outermost container in Outlook.com */
    .ReadMsgBody {
        width: 100%;
    }

    img {
        -ms-interpolation-mode: bicubic;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-family: Arial;
    }

    h1 {
        font-size: 28px;
        line-height: 32px;
        padding-top: 10px;
        padding-bottom: 24px;
    }

    h2 {
        font-size: 24px;
        line-height: 28px;
        padding-top: 10px;
        padding-bottom: 20px;
    }

    h3 {
        font-size: 20px;
        line-height: 24px;
        padding-top: 10px;
        padding-bottom: 16px;
    }

    p {
        font-size: 16px;
        line-height: 20px;
        font-family: Georgia, Arial, sans-serif;
    }

</style>
<style>
    .container600 {
        width: 600px;
        max-width: 100%;
    }

    @media all and (max-width: 599px) {
        .container600 {
            width: 100% !important;
        }
    }

</style>

<!--[if gte mso 9]>
    <style>
        .ol {
            width: 100%;
        }
    </style>
<![endif]-->

</head>

<body style="background-color:#F4F4F4;">
    @php
        $message = '';
        $book = '';
        $bookinfo = '';
        $bookinfo2 = '';
        $bookinfo3 = '';
            $book = DB::table('reservation_tables')
            ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
            ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
            ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
            ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
            ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
            ->leftJoin('payment_informations', 'guest_informations.payment_code', '=', 'payment_informations.payment_code')
            ->where('reservation_tables.confirmation_number', $confirmation_number)

            ->first();
            $user = false;
            if($book->first_name === null) {
                $book = DB::table('reservation_tables')
                ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                ->leftJoin('room_statuses', 'reserved_rooms.r1', '=', 'room_statuses.room_number')
                ->leftJoin('rate_descriptions', 'reserved_rooms.rate1', '=', 'rate_descriptions.rate_name')
                ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                ->leftJoin('room_descriptions', 'room_statuses.room_suite_name', '=', 'room_descriptions.room_name')
                ->leftJoin('payment_informations', 'users.payment_code', '=', 'payment_informations.payment_code')
                ->where('reservation_tables.confirmation_number', $confirmation_number)
                ->first();
                $user = true;


            }
            // dd($book);
                // This is the saddest code ive ever done
                if ($book->r2 != null || $book->r2 != "") {
                    $bookinfo2 = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r2', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate2', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id2', '=', 'head_counts.id')
                    ->where('reservation_tables.confirmation_number', $confirmation_number)
                    ->first();
                } else {
                    $bookinfo2 = null;
                }

                if ($book->r3 != null || $book->r3 != "") {
                    $bookinfo3 = DB::table('reservation_tables')
                    ->leftJoin('users', 'reservation_tables.user_id', '=', 'users.id')
                    ->leftJoin('guest_informations', 'reservation_tables.guest_code', '=', 'guest_informations.guest_code')
                    ->leftJoin('reserved_rooms', 'reservation_tables.rr_code', '=', 'reserved_rooms.rr_code')
                    ->leftJoin('room_statuses', 'reserved_rooms.r3', '=', 'room_statuses.room_number')
                    ->leftJoin('rate_descriptions', 'reserved_rooms.rate3', '=', 'rate_descriptions.rate_name')
                    ->leftJoin('computeds', 'reservation_tables.computed_price_id', '=', 'computeds.id')
                    ->leftJoin('head_counts', 'reserved_rooms.head_count_id3', '=', 'head_counts.id')

                    ->where('reservation_tables.confirmation_number', $confirmation_number)
                    ->first();
                } else {
                    $bookinfo3 = null;
                }

    @endphp

{{-- @if (session()->exists('confirmation_number')) --}}

<center>

    <!--[if gte mso 9]><table width="600" cellpadding="0" cellspacing="0"><tr><td><![endif]-->
    <table class="container600" cellpadding="0" cellspacing="0" border="0" width="100%"
        style="width:calc(100%);max-width:calc(600px);margin: 50px auto;">
        <tr>
            <td width="100%" style="text-align: left;">

                <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                    <tr>
                        <td style="background-color:#FFFFFF;color:#000000;padding:20px 50px; text-align: center;">
                            <link rel="icon" href="{{ asset('images/logomondstadt.png') }}">

                        </td>
                    </tr>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                    <!-- Order head  -->
                    <tr>
                        <td style="padding: 15px 50px; background-color:#FFF; border-top: 1px solid #e8e8e8">
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="padding:15px 0;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 25px; font-weight: bold; line-height:30px;">Reservation
                                                Number: {{ session('confirmation_number') }}</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">Welcome
                                                to Mondstadt!</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;">You
                                                are now booked! Do take note of your reservation number it will be
                                                used during your arrival
                                                <br>
                                                <br>
                                                <span style="text-decoration: none; color: #000000;"><b>Arrival
                                                        Date:</b> {{date("m/d/Y", strtotime($book->arrival_date))}}</span>
                                                <br>
                                                <span style="text-decoration: none; color: #000000;"><b>Departure
                                                        Date:</b> {{date("m/d/Y", strtotime($book->departure_date))}}</span>
                                                <br>
                                                <br>
                                                <span
                                                    style="text-decoration: none; color: #000000; font-weight:bold ">-Please
                                                    present a valid ID and your reservation number upon
                                                    arrival</span>
                                                <br>
                                                <span
                                                    style="text-decoration: none; color: #000000;  font-weight:bold">-For
                                                    foreigners please present a passport for verification</span>

                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <!--  -->

                    <!-- customer details -->
                    <tr>
                        <td style="padding: 15px 50px; background-color:#FFF; border-top: 1px solid #e8e8e8">
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="padding-top:15px;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                <b>Guest Name:</b>
                                            </span>
                                        </td>
                                        <td style="padding-top:15px; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                {{$book->first_name}} {{$book->last_name}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                <b>Email Address:</b>
                                            </span>
                                        </td>
                                        <td style="text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                {{$book->email}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 15px;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                <b>Contact Number:</b>
                                            </span>
                                        </td>
                                        <td style="padding-bottom: 15px; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                {{$book->mobile_num}}
                                            </span>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td style="padding-bottom: 15px;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                <b>Nights:</b>
                                            </span>
                                        </td>
                                        <td style="padding-bottom: 15px; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px; color: #000000;">
                                                {{$nights = (new DateTime(date('Y-m-d', strtotime($book->arrival_date))))->diff(new DateTime(date('Y-m-d', strtotime($book->departure_date))))->days;}}
                                            </span>
                                        </td>

                                    </tr>
                                </tbody>
                            </table>


                        </td>
                    </tr>

                    <!--  -->
                    <tr>
                        <td style="padding: 25px 50px; background-color:#FFF; border-top: 1px solid #e8e8e8">
                            <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                                <tbody>
                                    <tr>
                                        <td style="padding:15px 0;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">{{ $book->room_suite_name }}</span>
                                            <br>

                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                {{ $book->rate_name }}</span>

                                        </td>

                                        <td style="padding:15px 0; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                    Charge: </b>₱ @php
                                                    $price = DB::table('room_descriptions')
                                                        ->where('room_name', $book->room_suite_name)
                                                        ->first();
                                                    if ($price !== null) {
                                                        echo number_format($price->base_price, 2);
                                                    } else {
                                                        $price = DB::table('suite_descriptions')
                                                            ->where('suite_name', $book->room_suite_name)
                                                            ->first();
                                                        echo number_format($price->base_price, 2);
                                                    }
                                                    $promotiondiscount = DB::table('promotion_descriptions')
                                                    ->where('promotion_code', $book->promotion_code)
                                                    ->first();
                                                @endphp </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                    Charge: </b>₱ {{ number_format($service_charge = $price->base_price * $book->service_rate, 2) }} </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate Discoount: </b>₱ -@php
                                                    $rate_discount = $price->base_price * $book->base_discount;
                                                    if($promotiondiscount !== null){
                                                        $promo_discount = $price->base_price * $promotiondiscount->overall_cut;
                                                    } else {
                                                        $promo_discount = 0;
                                                    }
                                                    echo number_format($rate_discount + $promo_discount, 2)

                                                @endphp </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                </b>₱ @php
                                                    $city_tax = $price->base_price * $book->city_tax;
                                                    $vat = $price->base_price * $book->vat;
                                                    echo number_format($city_tax + $vat, 2);
                                                @endphp </span>
                                            <br>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                {{ number_format($total = (($price->base_price - ($rate_discount + $promo_discount)) + $vat + $service_charge + $city_tax)* $nights, 2) }}</span>
                                        </td>
                                    </tr>


                                    {{-- room 2 --}}
                                    @if ($bookinfo2 !== null)
                                        <tr>
                                            <td style="padding:15px 0;">
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">{{ $bookinfo2->room_suite_name }}</span>
                                                <br>

                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                    {{ $bookinfo2->rate_name }}</span>

                                            </td>

                                            <td style="padding:15px 0; text-align: right;">
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                        Charge: </b>₱ @php
                                                        $price = DB::table('room_descriptions')
                                                            ->where('room_name', $bookinfo2->room_suite_name)
                                                            ->first();
                                                        if ($price !== null) {
                                                            echo number_format($price->base_price, 2);
                                                        } else {
                                                            $price = DB::table('suite_descriptions')
                                                                ->where('suite_name', $bookinfo2->room_suite_name)
                                                                ->first();
                                                            echo number_format($price->base_price, 2);
                                                        }
                                                        $promotiondiscount = DB::table('promotion_descriptions')
                                                        ->where('promotion_code', $bookinfo2->promotion_code)
                                                        ->first();
                                                    @endphp </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                        Charge: </b>₱ {{ number_format($service_charge = $price->base_price * $bookinfo2->service_rate, 2) }} </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate Discoount: </b>₱ -@php
                                                        $rate_discount = $price->base_price * $bookinfo2->base_discount;
                                                        if($promotiondiscount !== null){
                                                            $promo_discount = $price->base_price * $promotiondiscount->overall_cut;
                                                        } else {
                                                            $promo_discount = 0;
                                                        }
                                                        echo number_format($rate_discount + $promo_discount, 2)

                                                    @endphp </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                    </b>₱ @php
                                                        $city_tax = $price->base_price * $bookinfo2->city_tax;
                                                        $vat = $price->base_price * $bookinfo2->vat;
                                                        echo number_format($city_tax + $vat, 2);
                                                    @endphp </span>
                                                <br>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                    {{ number_format($total = (($price->base_price - ($rate_discount + $promo_discount)) + $vat + $service_charge + $city_tax)* $nights, 2) }}</span>
                                            </td>
                                        </tr>

                                    @endif



                                    {{-- room 3 --}}
                                    @if ($bookinfo3 !== null)
                                        <tr>
                                            <td style="padding:15px 0;">
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">{{ $bookinfo3->room_suite_name }}</span>
                                                <br>

                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                    {{ $bookinfo3->rate_name }}</span>

                                            </td>

                                            <td style="padding:15px 0; text-align: right;">
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                        Charge: </b>₱ @php
                                                        $price = DB::table('room_descriptions')
                                                            ->where('room_name', $bookinfo3->room_suite_name)
                                                            ->first();
                                                        if ($price !== null) {
                                                            echo number_format($price->base_price, 2);
                                                        } else {
                                                            $price = DB::table('suite_descriptions')
                                                                ->where('suite_name', $bookinfo3->room_suite_name)
                                                                ->first();
                                                            echo number_format($price->base_price, 2);
                                                        }
                                                        $promotiondiscount = DB::table('promotion_descriptions')
                                                        ->where('promotion_code', $bookinfo3->promotion_code)
                                                        ->first();
                                                    @endphp </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                        Charge: </b>₱ {{ number_format($service_charge = $price->base_price * $bookinfo3->service_rate, 2) }} </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate Discoount: </b>₱ -@php
                                                        $rate_discount = $price->base_price * $bookinfo3->base_discount;
                                                        if($promotiondiscount !== null){
                                                            $promo_discount = $price->base_price * $promotiondiscount->overall_cut;
                                                        } else {
                                                            $promo_discount = 0;
                                                        }
                                                        echo number_format($rate_discount + $promo_discount, 2)

                                                    @endphp </span>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                    </b>₱ @php
                                                        $city_tax = $price->base_price * $bookinfo3->city_tax;
                                                        $vat = $price->base_price * $bookinfo3->vat;
                                                        echo number_format($city_tax + $vat, 2);
                                                    @endphp </span>
                                                <br>
                                                <br>
                                                <span
                                                    style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                    {{ number_format($total = (($price->base_price - ($rate_discount + $promo_discount)) + $vat + $service_charge + $city_tax)* $nights, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endif

                                    <tr>
                                        <td style="padding:15px 0;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;"></span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"></span>
                                        </td>
                                        <td style="padding:15px 0; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;">Deposited:</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 28px; font-weight: bold; line-height:30px;">PHP
                                                @if (session('adminreservation'))
                                                    0.00</span>
                                                @else
                                                    {{ number_format(session('overallprice') * 0.5, 2) }}</span>
                                                @endif

                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;">To
                                                Pay:</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 28px; font-weight: bold; line-height:30px;">PHP
                                                @if (session('adminreservation'))
                                                    {{ number_format(session('overallprice'), 2) }}</span>
                                                @else
                                                    {{ number_format(session('overallprice') * 0.5, 2) }}</span>
                                                @endif

                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;">Total:</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 28px; font-weight: bold; line-height:30px;">PHP
                                                {{ number_format(session('overallprice'), 2) }}</span>

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <!--  -->

                </table>
                <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                    <tr>
                        <td width="100%" style="min-width:100%;padding:15px; text-align: center;">
                            <p style="font-size:12px;line-height:20px;font-family: Arial,sans-serif;">&copy;2021
                                Mondstadt Hotel</p>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <button onClick="window.print()">Print this page</button>
</center>

@else

<h1>An error occured reloading the page.</h1>

@endif

{{--
@php
    Session::forget(['CheckIn', 'CheckOut', 'RoomCount', 'AdultCount', 'ChildCount', 'PromoCode', 'room', 'roomchecker', 'roomchecker2', 'roomtype2', 'ratetype2', 'bedcheckerq', 'bedcheckerk', 'roomtype', 'ratetype', 'bed', 'totalrate', 'overallprice', 'success', 'confirmation_number']);
@endphp --}}
</body>

</html>
