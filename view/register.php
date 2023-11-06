<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Registro</title>
    <link rel="stylesheet" href="public/css/register.css">
</head>

<body>
    <div class="flotante">
        <a href="javascript:history.back();">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>

    <?php
    if (isset($_GET['msg'])) {
        $mensaje = htmlspecialchars($_GET['msg']);       
        if ($mensaje === 'Error al registrar... El correo ya está registrado') {            
            $clase_alerta = 'alerta-danger';
        }
        else{
            $clase_alerta = 'alerta-success';
        }
        echo '<div class=" alerta ' . $clase_alerta . ' "><p>' . $mensaje . '</p></div>';
    }
    ?>

    <section class="section-principal">
        <section class="section-1">
            <img src="public/img/utp-icon.png" alt="utp-logo" class="img-register">
        </section>
        <section class="section-2">
            <form method="post" action="?op=registerController">
                <h2>Formulario de Registro</h2>
                <div class="flex-column">
                    <label>Nombre:</label>
                    <input type="text" name="name" placeholder="Ingrese su nombre" required>
                </div>
                <div class="flex-column">
                    <label>Correo Electrónico:</label>
                    <input type="email" name="email" placeholder="Ingrese su correo electrónico" required>
                </div>
                <div class="flex-column">
                    <label>Contraseña:</label>
                    <input type="password" name="pass" placeholder="Ingrese su contraseña" required>
                </div>
                <div class="enlaces">
                    <button type="submit">Registrarse</button>
                    <a href="?op=login">Ya tienes cuenta? <span style="color: #7a1d78; font-weight: bold;">Inicia Sesión</span> </a>
                </div>
            </form>
        </section>
    </section>
    <script src="public/js/register.js"></script>
</body>

</html>