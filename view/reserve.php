<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $equipo_id = $_POST['equipo_id']; //Obtiene el ID del equipo
    $controller = new Controller();
    $equipo = $controller->GetComputerById($equipo_id); //optiene la informacion del equipo

    $delete = $equipo_id  . '_';
    $img = str_replace($delete, '', $equipo['img']);

    if (!isset($_SESSION['user_id'])) {
        header("Location: ?op=noRegistrado");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="public/img/utp-icon.png">
    <title>Reserva</title>
    <link rel="stylesheet" href="public/css/reserve.css">
</head>

<body>
    <div class="flotante">
        <a href="javascript:history.back();">
            <img src="public/img/atras.png" alt="atras">
            <button>Volver</button>
        </a>
    </div>

    <?php
    if ($equipo) {
        //cuando se elige el equipo mostrara el formulario
        echo '<section>';
        echo '<h1>Formulario de Reserva</h1>';        

        echo '<form action="?op=reserveController" method="post" class="section-principal">
                <section class="section-1">
                    <img src="public/img/' . $img . '">
                    <h2>' . $equipo['name'] . '</h2>
                </section>

                <section class="section-2">
                    <input type="hidden" name="equipo_id" value="' . $equipo_id . '">

                    <div class="dia flex">
                        <label for="day">Día:</label>
                        <input type="date" id="day" name="day" required>
                    </div>

                    <div class="hora-inicio flex">
                        <label for="start_time">Hora de inicio:</label>
                        <input type="time" id="start_time" name="start_time" required>
                    </div>
                
                    <div class="hora-final flex">
                        <label for="end_time">Hora de fin:</label>
                        <input type="time" id="end_time" name="end_time" required>
                    </div>
                </section>        
         
                <button type="submit">Confirmar Reserva</button>
            </form>';
    }
    ?>
</body>

</html>