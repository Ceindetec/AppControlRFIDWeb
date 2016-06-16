
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login Control RFID</title>

    {!!Html::style('css/login.css')!!}    
</head>

<body>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>


    <form method="POST" action="/auth/login">
        {!! csrf_field() !!}
        <h4> Login de usuario </h4>
        <input class="name" type="text" placeholder="Ingrese documento" name="usu_username" required />
        <input class="pw" type="password" placeholder="Ingrese contraseña" name="password" required />
        <!--<li><a href="#">Forgot your password?</a></li>-->
        <input class="button" type="submit" value="Login"/>
    </form>
    
    
    
    
    
</body>
</html>
