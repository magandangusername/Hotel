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
                                                        Date:</b> 01/10/11</span>
                                                <br>
                                                <span style="text-decoration: none; color: #000000;"><b>Departure
                                                        Date:</b> 01/10/11</span>
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
                                                Jonh Mark
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
                                                JonhMark@email.com
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
                                                0929 666 6666
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
                                                style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">Standard
                                                Room</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Nights:</b>
                                                5</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                Breakfast</span>

                                        </td>
                                        <td style="padding:15px 0; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                    Charge: </b>₱ 750.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                    Charge: </b>₱ 50.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                </b>₱ 10.00 </span>
                                            <br>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                1,500.00</span>
                                        </td>
                                    </tr>
                                    <!--  -->
                                    <tr>
                                        <td style="padding:15px 0;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">Standard
                                                Room</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Nights:</b>
                                                5</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                Breakfast</span>

                                        </td>
                                        <td style="padding:15px 0; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                    Charge: </b>₱ 750.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                    Charge: </b>₱ 50.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                </b>₱ 10.00 </span>
                                            <br>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                1,500.00</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="padding:15px 0;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 20px; font-weight: bold; line-height:30px;">Standard
                                                Room</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Nights:</b>
                                                5</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Rate:</b>
                                                Breakfast</span>

                                        </td>
                                        <td style="padding:15px 0; text-align: right;">
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Room
                                                    Charge: </b>₱ 750.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Extra
                                                    Charge: </b>₱ 50.00 </span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;"><b>Tax:
                                                </b>₱ 10.00 </span>
                                            <br>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 18px; font-weight: bold; line-height:30px;">₱
                                                1,500.00</span>
                                    </tr>
                                    <!--  -->

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
                                                {{ number_format(session('overallprice') * 0.5, 2) }}</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 14px; line-height:25px;">To
                                                Pay:</span>
                                            <br>
                                            <span
                                                style="font-family: Arial,sans-serif; font-size: 28px; font-weight: bold; line-height:30px;">PHP
                                                {{ number_format(session('overallprice') * 0.5, 2) }}</span>
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
