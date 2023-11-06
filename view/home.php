<?php
$controller = new Controller();
$salones = $controller->GetSalonesController();
$equipos = $controller->GetComputersController();

$controller->GetTimeReserve();

$equiposPorLinea = 5;
$totalEquipos = count($equipos);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Reserva de Equipo</title>
    <link rel="stylesheet" href="public/css/home.css">
</head>

<body>

    <?php
    if (isset($_GET['msg'])) {
        $mensaje = htmlspecialchars($_GET['msg']);
        if ($mensaje === 'Equipo Reservado' || $mensaje === 'Bienvenido') {
            $clase_alerta = 'alerta-success';
        } else {
            $clase_alerta = 'alerta-danger';
        }
        echo '<div class=" alerta ' . $clase_alerta . ' "><p>' . $mensaje . '</p></div>';
    }
    ?>

    <nav>
        <div class="img-label">
            <img src="public/img/utp-icon.png" alt="utp">
            <label>
                <?php
                if (isset($_SESSION['user_name'])) {
                    echo $_SESSION['user_name'];
                } else {
                    echo 'Visitante';
                }
                ?>
            </label>
        </div>
        <div class="botones">
            <?php
            if (!empty($_SESSION['user_id']) && $_SESSION['user_rol'] == 'adm') {
                echo '<a href="?op=reserveList"><button type="button">Reservas</button></a>';
            }
            ?>
            <a href="?op=register"><button type="button">Registrarse</button></a>
            <a href="?op=login"><button type="button">Iniciar Sesion</button></a>
            <a href="?op=logout"><button type="button">Cerrar Sesion</button></a>
        </div>
    </nav>

    <div class="titulo">
        <h1>Reserva de Computadoras</h1>
    </div>

    <section class="section-principal">
        <section class="section-1">
            <div class="selec-salon">
                <label>Seleccionar salón</label>
                <select name="select" id="salonSelect">
                    <?php
                    foreach ($salones as $salon) {
                        echo '<option value="' . $salon['id'] . '">' . $salon['name'] . '</option>';
                    }
                    ?>
                </select>
            </div>
        </section>

        <section class="section-2">
            <div class="equipos">
                <?php for ($i = 0; $i < $totalEquipos; $i += $equiposPorLinea) : ?>
                    <div class="linea linea<?= ($i / $equiposPorLinea + 1) ?>">
                        <?php for ($j = $i; $j < min($i + $equiposPorLinea, $totalEquipos); $j++) :
                            $equipo = $equipos[$j]; ?>
                            <?php
                            // Agrega una clase basada en el estado
                            $statusClass = ($equipo['status'] == 'Disponible') ? 'available' : 'occupied'; ?>
                            <div class="eq eq<?= $equipo['id'] ?> <?= $statusClass ?>" data-salon-id="<?= $equipo['id_salon'] ?>">
                                <img id="equipo-<?= $equipo['id'] ?>" src="public/img/pc.png" alt="pc<?= $equipo['id'] ?>">
                                <label><?= $equipo['name'] ?></label>
                                <p><?= $equipo['status'] ?></p>
                            </div>
                        <?php endfor; ?>
                    </div>
                <?php endfor; ?>
            </div>
        </section>
    </section>

    <footer>
        <div>
            <p class="fuente">Ameth Cebrián | 8-987-2235</p>
        </div>
        <p class="fuente">1LS131</p>
        <div>
            <p class="fuente">Rivaldo Quirós | 2-987-2235</p>
        </div>
    </footer>

    <script src="public/js/home.js"></script>
</body>

</html>