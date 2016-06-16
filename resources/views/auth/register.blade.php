
<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <title>Login Control RFID</title>

    {!!Html::style('css/login.css')!!}    
</head>

<body>

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>


    <form method="POST" action="/auth/register">
        {!! csrf_field() !!}
        <h4> Registro de usuario </h4>
        <input class="name" type="text" name="name" placeholder="Nombre de usuario" required />
        <input class="pw" type="password" name="password" placeholder="Ingrese contraseña" required />
        <input class="pw" type="password" name="password_confirmation" placeholder="Confirme contraseña" required />
        <select class="name" name="tusuario" required>
        	<option value="">Seleccione tipo de usuario</option>
        	<option value="1">Administrador</option>
        	<option value="2">Controlador</option>
        </select>
        <!--<li><a href="#">Forgot your password?</a></li>-->
        <input class="button" type="submit" value="Registrar"/>
    </form>
    
        
</body>
</html>
