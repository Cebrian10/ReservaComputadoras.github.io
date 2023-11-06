<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Usuario no Registrado</title>
    <link rel="stylesheet" href="public/css/no-registrado.css">
</head>

<body>
    <div class="flotante">
        <a href="javascript:history.back();">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>

    <div class="mensaje">
        <h1>Debes registrarte primero</h1>
        <p>Por favor, inicia sesión o regístrate para acceder a esta página.</p>
        <div class="botones">
            <a href="?op=register" class="boton-registro">Registrarse</a>
            <a href="?op=login" class="boton-registro">Iniciar Sesion</a>
        </div>
    </div>
</body>

</html>