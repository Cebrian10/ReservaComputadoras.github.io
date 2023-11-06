<?php
session_start();

require_once('./config/DatosDB.php');
require_once('model/DB.php');
class Model
{
    private $pdo;
    public $name;
    public $email;
    public $pass;
    public $hashedPassword;
    public $rol;
    public $equipo_id;
    public $day;
    public $start_time;
    public $end_time;
    public $id_usuarios;
    public function __CONSTRUCT()
    {
        try {
            $this->pdo = DB::StartUp();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function LoginModel(Model $data)
    {
        try {
            $sql = "SELECT email, pass FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $result = $stmt->fetch();

            return ($result && password_verify($data->pass, $result['pass']));
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }

    public function VerificarSesion(Model $data)
    {
        try {
            $sql = "SELECT id FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $result = $stmt->fetch();

            if ($result) {
                $sesiones_activas = isset($_SESSION['sesiones_activas']) ? $_SESSION['sesiones_activas'] : [];

                if (in_array($result['id'], $sesiones_activas)) {
                    return false;
                } else {
                    $sesiones_activas[] = $result['id'];
                    $_SESSION['sesiones_activas'] = $sesiones_activas;

                    return true;
                }
            } else {
                return false;
            }
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }

    public function ObtenerDatosUser(Model $data)
    {
        try {
            $sql = "SELECT id, name, email, rol FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $result = $stmt->fetch();

            if ($result) {
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['user_name'] = $result['name'];
                $_SESSION['user_email'] = $result['email'];
                $_SESSION['user_rol'] = $result['rol'];
            }
        } catch (Exception $e) {
            session_destroy();
            die($e->getMessage());
        }
    }

    public function RegisterModel(Model $data)
    {
        if (!$this->VerificarExistenciaEmail($data)) {
            try {
                $sql = "INSERT INTO usuarios (name, email, pass, rol) VALUES (?,?,?,?)";
                $stmt = $this->pdo->prepare($sql);
                $result = $stmt->execute(array(
                    $data->name,
                    $data->email,
                    $data->hashedPassword,
                    $data->rol = 'usr'
                ));
                return $result;
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            return false;
        }
    }

    public function VerificarExistenciaEmail(Model $data)
    {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->email]);
            $count = $stmt->fetchColumn();
            return $count > 0;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ReserveModel(Model $data)
    {
        try {
            $sql = "INSERT INTO reservas (day, start_time, end_time, id_usuarios, id_equipos) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute(array(
                $data->day,
                $data->start_time,
                $data->end_time,
                $data->id_usuarios = $_SESSION['user_id'],
                $data->equipo_id
            ));
            return $result;
        } catch (Exception $e) {
            return false;
        }
    }

    public function ReservarEquipo($equipo_id)
    {
        try {
            $sql = "UPDATE computadoras SET status = 'Ocupado' WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$equipo_id]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetComputersModel()
    {
        try {
            $sql = "SELECT * FROM computadoras";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetSalonesModel()
    {
        try {
            $sql = "SELECT * FROM salones";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetComputerByIdModel($equipo_id)
    {
        try {
            $sql = "SELECT * FROM computadoras WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$equipo_id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetReserveModel()
    {
        try {
            $sql =
                "SELECT reservas.day, reservas.start_time, reservas.end_time, usuarios.name AS name_user
            FROM reservas
            INNER JOIN usuarios ON reservas.id_usuarios = usuarios.ID;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function GetReservesModel()
    {
        try {
            $sql = "SELECT * FROM reservas";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function UpdateStatusComputer($status, $equipo_id)
    {
        try {
            $sql = "UPDATE computadoras SET status = ? WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute(array(
                $status,
                $equipo_id                
            ));
            return $result;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
