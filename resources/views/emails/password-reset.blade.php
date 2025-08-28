<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h2>Hello {{ $user->name }},</h2>
    <p>Please click below link to reset your password</p>
    <a href="{{ route('reset.password', $token) }}">Click here</a>
</body>

</html>
