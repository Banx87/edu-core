<!doctype html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Instructor request approved</title>
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/responsive.css') }}">

    @vite(['resources/css/mail.css'])
</head>

<body>
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body">
        <tr>
            <td class="wrapper">
                <p>Name: {{ old('name', $name) }},</p>
                <p>Email: {{ old('email', $email) }},</p>
                <p>Subject: {{ old('subject', $subject) }}</p>
                <p>Message: {{ old('contact_message', $contact_message) }}</p>
                <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                    <tbody>
                        <tr>
                            <td align="left">
                                <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <a href="{{ url('/instructor-dashboard') }}" target="_blank">
                                                    To your dashboard
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <p>Best wishes on your journey as an instructor!</p>
            </td>
        </tr>
    </table>
</body>

</html>
