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
                <p>Hello,</p>
                <p>Congratulations! Your request to become an instructor has been approved. You are now empowered to
                    share your knowledge and publish courses on our platform. We can't wait to see the amazing content
                    you'll create!</p>
                <p>We are thrilled to have you on board as an instructor. If you have any questions or need assistance,
                    feel free to reach out to our support team.</p>
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
