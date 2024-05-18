<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/style.css">
    <title>Registro</title>
    <style>
        body{
            background-color:  rgb(178, 251, 178);
        }

        .botonn{
            background: rgb(0, 79, 0);
            cursor: pointer;
        }
        .form-control{
            border: 2px solid rgb(0, 79, 0);
        }
        .bod{
            border: 2px solid rgb(0, 79, 0);
            width: 380px;
            height: 400px; 
            margin-top: 30px;
        }
        .bod h4{
            color: rgb(0, 79, 0);
        }
        .bod a{
            color: rgb(0, 79, 0);
        }
        .form-control:focus{
            outline: none;
        }
    @media (max-width: 500px) {
        .bod{
            width: 300px;
        }
        @media (max-width: 280px) {
        .bod{
            width: 200px;
        }
    }
}
    </style>
</head>
<body>
    <div class="bod">
        <h4>Registrate</h4>
        <form method="POST" action="regisproceso.php">
            <input type="text" class="form-control" name="txtNombre" placeholder="Ingrese su Nombre">
			<input type="email" class="form-control" name="txtEmail" placeholder="Ingrese su Correo">
			<input type="password" class="form-control" name="txtPass" placeholder="Ingrese su Contraseña">
            <input type="hidden" name="oculto" value="1">
            <input type="submit" class="botonn" value="Registrarse">
		</form>
        <p><a href="login.php">¿Ya tengo cuenta?</a></p>
    </div>
</body>
</html>