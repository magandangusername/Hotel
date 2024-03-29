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
        <center>
            <table class="container600" cellpadding="0" cellspacing="0" border="0" width="100%" style="width:calc(100%);max-width:calc(600px);margin: 0 auto;">
                <tr>
                    <td width="100%" style="text-align: left;">
                        <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                            <tr>
                                <td style="background-color:#FFFFFF;color:#000000;padding:30px;">
                                    <img src="{{asset('images/anemo.png')}}" width="160" style="display: block; margin: auto" />
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                            <tr>
                                <td style="padding:80px 50px; background-color:#FFFFFF; border-top: 1px solid #e8e8e8"">
                                    <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                                        <tbody>

                                            <tr>
                                                <td style="padding:5px; font-family: Arial,sans-serif; font-size: 16px; line-height:30px;text-align:left;">
                                                     Hello<b> {{$name}}</b>,
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding:5px; font-family: Arial,sans-serif; font-size: 16px; line-height:30px;text-align:left;">
                                                    Your Cancellation approved

                                                </td>
                                                <td style="padding:5px; font-family: Arial,sans-serif; font-size: 16px; line-height:30px;text-align:left;">

                                                    Amount: {{$amount}} PHP
                                                </td>
                                            </tr>


                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </table>
                        <table width="100%" cellpadding="0" cellspacing="0" style="min-width:100%;">
                            <tr>
                                <td width="100%" style="min-width:100%;background-color:#2d2d2d;color:#ffffff;padding:20px;">
                                    <p style="font-size:12px;line-height:20px;font-family: Arial,sans-serif;text-align:center;">&copy;2021 Mondstadt</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <!--[if gte mso 9]></td></tr></table><![endif]-->
        </center>
    </body>
    </html>
