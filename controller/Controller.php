<?php
require_once('model/Model.php');

class Controller
{
    private $model;

    public function __construct()
    {
        $this->model = new Model();
    }

    public function Home()
    {
        require('view/home.php');
    }

    public function Login()
    {
        require('view/login.php');
    }

    public function NoRegistrado()
    {
        require('view/no-registrado.php');
    }

    public function Register()
    {
        require('view/register.php');
    }

    public function ReserveList()
    {
        require('view/reserve-list.php');
    }

    public function Reserve()
    {
        require('view/reserve.php');
    }

    public function LoginController()
    {
        $usuario = new Model();

        $usuario->email = $_REQUEST['email'];
        $usuario->pass = $_REQUEST['pass'];

        if ($this->model->LoginModel($usuario)) {
            if ($this->model->VerificarSesion($usuario)) {
                $this->model->ObtenerDatosUser($usuario);
                header('Location: ?op=home');
            } else {
                header('Location: ?op=login&msg=Error... Sesión Existente');
            }
        } else {
            header('Location: ?op=login&msg=Error... Credenciales Inválidas');
        }
    }
    public function RegisterController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['pass'])) {
            } else {
                $usuario = new Model();

                $usuario->name = $_REQUEST['name'];
                $usuario->email = $_REQUEST['email'];
                $usuario->pass = $_REQUEST['pass'];
                $usuario->hashedPassword = password_hash($usuario->pass, PASSWORD_DEFAULT);

                $result = $this->model->RegisterModel($usuario);
                if ($result === true) {
                    header('Location: ?op=login&msg=Registro Exitoso');
                } else {
                    header('Location: ?op=register&msg=Error al registrar... El correo ya está registrado');
                }
            }
        }
    }

    public function ReserveController()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['equipo_id']) || empty($_POST['day']) || empty($_POST['start_time']) || empty($_POST['end_time'])) {
            } else {
                $usuario = new Model();

                $usuario->equipo_id = $_REQUEST['equipo_id'];
                $usuario->day = $_REQUEST['day'];
                $usuario->start_time = $_REQUEST['start_time'];
                $usuario->end_time = $_REQUEST['end_time'];

                $result = $this->model->ReserveModel($usuario);

                if ($result) {
                    $this->model->ReservarEquipo($usuario->equipo_id);
                    header('Location: ?op=home&msg=Equipo Reservado');
                } else {
                    header('Location: ?op=reserve&msg=El equipo no se pudo reservar');
                }
            }
        }
    }

    public function Logout()
    {
        $usuario = new Model();
        $usuario->email = $_SESSION['user_email'];

        if (isset($_SESSION['sesiones_activas'])) {
            $sesiones_activas = $_SESSION['sesiones_activas'];
            $user_id = array_search($usuario->email, $sesiones_activas);

            if ($user_id !== false) {
                unset($sesiones_activas[$user_id]);
                $_SESSION['sesiones_activas'] = $sesiones_activas;
            }
        }
        session_destroy();
        header('Location: ?op=home');
    }

    public function GetComputersController()
    {
        return $this->model->GetComputersModel();
    }

    public function GetSalonesController()
    {
        return $this->model->GetSalonesModel();
    }

    public function GetComputerById($equipo_id)
    {
        return $this->model->GetComputerByIdModel($equipo_id);
    }

    public function GetReserveController()
    {
        return $this->model->GetReserveModel();
    }

    public function GetTimeReserve()
    {
        date_default_timezone_set('America/Panama');
        $dia_actual = date('Y-m-d'); // Año-Mes-Día
        $hora_actual = date('H:i:s');  // Hora:Minutos:Segundos

        $reservas = $this->model->GetReservesModel();

        foreach ($reservas as $reserva) {

            $fechaActual = $dia_actual . ' ' . $hora_actual;
            $fechaFinalReserva = $reserva['day'] . ' ' . $reserva['end_time'];

            if ($fechaActual > $fechaFinalReserva) {
                $equipo_id = $reserva['id_equipos'];
                $this->model->UpdateStatusComputer('Disponible', $equipo_id);
            }
        }
    }
}
