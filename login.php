<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Iniciar Sesion</title>
    <style>
        body{
            background-color:  rgb(178, 251, 178);
        }

        .botonn{
            background: rgb(0, 79, 0);
        }
        .form-controlL{
            border: 2px solid rgb(0, 79, 0);
        }
        .bod{
            border: 2px solid rgb(0, 79, 0);
        }
        .bod h4{
            color: rgb(0, 79, 0);
        }
        .bod a{
            color: rgb(0, 79, 0);
        }
        
    @media (max-width: 500px) {
        .bod{
            width: 350px;
        }
    }
    @media (max-width: 280px) {
        .bod{
            width: 260px;
        }
    }
    </style>
</head>
<body>
    <div class="bod">
    <h4>Iniciar Sesion</h4>
        <form method="POST" action="loginproceso.php">
			<input type="email" class="form-controlL" name="txtEmail" autocomplete="off" placeholder="Ingrese su Correo">
			<input type="password" class="form-controlL" name="txtPass" placeholder="Ingrese su Contraseña">
			<input type="submit" class="botonn" value="Iniciar sesión" id="boton">
		</form>
        <p><a href="registro.php">¿No tienes cuenta? Registrate</a></p>
    </div>
</body>
</html>