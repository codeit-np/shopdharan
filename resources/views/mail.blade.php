<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
</head>
<body>
    <section>
        <p>
            <a href="{{ $link }}?token={{ $token }}&email={{ $email }}">
                Click Here To Reset Your Password
            </a>
        </p>
        <p>Your Token is <b>{{ $token }}</b> </p>
    </section>
</body>
</html>