<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="img/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="estilos/login.css">
    <title>Iniciar Sesión | Estadísticas de Jugadores</title>
</head>
<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="form-signUp" method="POST" action="regisproceso.php">
                <h1>¡Registra tu Torneo!</h1>
                <p id="p-white" style="margin-top: -4px">Empieza a llevar un control detallado de las estadísticas de tus jugadores.</p>
                <input type="text" class="form-control" name="txtNombre" placeholder="Nombre del Torneo">
                <input type="email" class="form-control" name="txtEmail" placeholder="Correo Electrónico">
                <input type="password" class="form-control" name="txtPass" placeholder="Contraseña">
                <input type="hidden" name="oculto" value="1">
                <button type="submit" style="margin-top: 20px;">Registrar</button>
                <a id="register-mov" href="index.php">Iniciar Sesión</a>
            </form>
        </div>
        <div class="form-container sign-in">
            <form id="form-signIn" method="POST" action="loginproceso.php">
                <h1>¡Bienvenido de Nuevo!</h1>
                <p id="p-white" style="margin-top: -4px">Ingresa para continuar gestionando las estadísticas de tus jugadores.</p>
                <input type="email" name="txtEmail" placeholder="Correo Electrónico">
                <input type="password" name="txtPass" placeholder="Contraseña">
                <button type="submit" style="margin-top: 20px;">Ingresar</button>
                <a id="register-mov" href="register.php">Registrarse</a>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Hola de Nuevo!</h1>
                    <p>Ingresa tus credenciales para continuar registrando las estadísticas de tus jugadores.</p>
                    <button class="hidden" id="login">Iniciar Sesión</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Únete a Nosotros!</h1>
                    <p>Crea tu cuenta y empieza a gestionar estadísticas de goles, asistencias, tarjetas amarillas y rojas.</p>
                    <button class="hidden" id="register">Registrarse</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script/login.js"></script>
</body>
</html>
