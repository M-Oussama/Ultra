<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body {
                font-family: "DejaVu Sans", sans-serif !important;
            }
        </style>
    </head>
    <body>
        <h1>مرحبا</h1>
        <h1>name : {{$user->name}}</h1>
        <h1>surname : {{$user->surname}}</h1>
        <h1>email : {{$user->email}}</h1>
        <h1>birthdate : {{$user->birthdate}}</h1>
        <h1>role : {{$user->roles->first()->name}}</h1>
    </body>
</html>
