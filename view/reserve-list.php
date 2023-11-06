<?php
$controller = new Controller();
$reserves = $controller->GetReserveController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Lista de Reservaciones</title>
    <link rel="stylesheet" href="public/css/reserve-list.css">
</head>

<body>
    <div class="flotante">
        <a href="javascript:history.back();">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>

    <h1>Listado de Reservaciones</h1>
    
    <table>
        <thead>
            <tr>
                <th>Día</th>
                <th>Hora de inicio</th>
                <th>Hora de fin</th>
                <th>Nombre de usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reserves as $reserve) : ?>
                <tr>
                    <td>
                        <?php
                         $fecha = $reserve['day']; 
                         $fecha_formateada = date('d-m-Y', strtotime($fecha));
                         echo''.$fecha_formateada.'';
                         ?>
                    </td>
                    <td><?php echo $reserve['start_time']; ?></td>
                    <td><?php echo $reserve['end_time']; ?></td>
                    <td><?php echo $reserve['name_user']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>