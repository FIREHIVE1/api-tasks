{{--<h1>Hi {{ $user->name }}</h1>--}}
{{--<p>Please use the following code to reset your password:</p>--}}
{{--<br/>--}}
{{--<p style="font-weight: bold">{{ $user->forgot_code }}</p>--}}
{{--<p>Create react app team!</p>--}}

        <!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
</head>

<body>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td align="center" valign="top">
            <table border="0" cellpadding="20" cellspacing="0" width="100%">
                <tr style="background-color: #e8ecef; color: grey;">
                    <td align="center">
                        <table border="0" cellspacing="0" width="100%">
                            <tr>
                                <td align="center">
                                    <a href=""
                                       style=" font-family:Avenir, Helvetica, sans-serif;color:#969696;font-size:19px;font-weight:bold;text-decoration:none;text-shadow:0 1px 0 white;">Tasks</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>

                    <table align="center" width="570" cellpadding="0" cellspacing="0"
                           style="font-family:Avenir, Helvetica, sans-serif;background-color:#FFFFFF;margin:0 auto;padding:0;width:600px;">
                        <tbody>
                        <tr>
                            <td align="center"
                                style="font-family:Avenir, Helvetica, sans-serif;background-color:#FFFFFF;margin:0;padding:0;width:10%;padding: 30px;">

                                <h1 style="font-family:Avenir, Helvetica, sans-serif;color:#2F3133;font-size:19px;font-weight:bold;margin-top:0;text-align:left">
                                    Hi {{ $user->name }},</h1>
                                <p style="font-family:Avenir, Helvetica, sans-serif;color:#74787E;font-size:16px;line-height:1.5em;margin-top:0;text-align:left;">
                                    You are receiving this email because we received a password reset request for your account.
                                    <br>
                                    Please copy the following code to your website to change your password.

                                <table align="center" width="100%" cellpadding="0" cellspacing="0"
                                       style="font-family:Avenir, Helvetica, sans-serif;margin:30px auto;padding:0;text-align:center;width:100%;">
                                    <tbody>
                                    <tr>
                                        <td style="font-family:Avenir, Helvetica, sans-serif;">
                                            <p style="font-family:Avenir, Helvetica, sans-serif;border-radius:3px;font-size: 14px; color:#FFF;display:inline-block;text-decoration:none;background-color:#3097D1;border-top:10px solid #3097D1;border-right:25px solid #3097D1;border-bottom:10px solid #3097D1;border-left:25px solid #3097D1;">{{ $user->forgot_code }}</p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>

                                <p style="font-family:Avenir, Helvetica, sans-serif;color:#74787E;font-size:16px;line-height:1.5em;margin-top:0;text-align:left;">
                                    If you did not request a password reset, no further action is required.</p>

                                <p style="font-family:Avenir, Helvetica, sans-serif;color:#74787E;font-size:16px;line-height:1.5em;margin-top:0;text-align:left;">
                                    Regards,<br>Tasks</p>


                            </td>
                        </tr>
                        </tbody>
                    </table>

                </tr>

                <tr style="background-color: #e8ecef; color: grey;">
                    <td align="center">
                        <table border="0" cellpadding="20" cellspacing="0" width="100%">
                            <tr>
                                <td align="center " valign="top">
                                    <p style="font-family:Avenir, Helvetica, sans-serif;line-height:1.5em;margin-top:0;color:#969696;font-size:12px;text-align:center">
                                        © 2018 Tasks. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>

