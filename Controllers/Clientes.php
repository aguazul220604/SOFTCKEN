<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    // función de la vista principal del controlador
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['perfil'] = 'si';
        $data['title'] = 'Tu perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }
    // función que permite obtener datos para el registro de nuevos usuarios
    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['password'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['password'])) {
                $mensaje = array('msg' => 'Campos incompletos', 'icono' =>  'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['password'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'Registro exitoso', 'icono' =>  'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'Error', 'icono' =>  'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Ya tienes una cuenta registrada', 'icono' =>  'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    // función que permite enviar correos de verificación
    public function Enviarcorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = HOST_SMTP;                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = USER_SMTP;                     //SMTP username
                $mail->Password   = PASS_SMTP;                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = PUERTO_SMTP;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('garciaguazul12@gmail.com', 'Alitas ALEX');
                $mail->addAddress($_POST['correo']);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Alitas ALEX';
                $mail->Body = 'Verificación de correo electrónico <a href="' . BASE_URL . 'clientes/verificarCorreo/' . $_POST['token'] . '">AQUÍ</a>';
                $mail->AltBody = 'Gracias por su lealtad';

                $mail->send();
                $mensaje = array('msg' => 'Correo enviado', 'icono' =>  'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'ERROR AL ENVIAR CORREO: ' . $mail->ErrorInfo, 'icono' =>  'error');
            }
        } else {
            $mensaje = array('msg' => 'ERROR FATAL', 'icono' =>  'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }
    // función que tare los datos de verifiación del correo
    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }
    //login directo
    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['passwordLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['passwordLogin'])) {
                $mensaje = array('msg' => 'Campos incompletos', 'icono' =>  'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['passwordLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'Bienvenido', 'icono' =>  'success');
                    } else {
                        $mensaje = array('msg' => 'Contraseña incorrecta', 'icono' =>  'error');
                    }
                } else {
                    $mensaje = array('msg' => 'El correo no existe', 'icono' =>  'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }
    // función que permite registrar pedidos
    public function registrarPedido()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        
        $pedidos = $json['pedidos'];
        $productos = $json['productos'];

        if (is_array($pedidos) && is_array($productos)) {
            $id_transaccion = $pedidos['id'];
            $monto = $pedidos['purchase_units'][0]['amount']['value'];
            $estado = $pedidos['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedidos['payer']['email_address'];
            $nombre = $pedidos['payer']['name']['given_name'];
            $apellido = $pedidos['payer']['name']['surname'];
            $direccion = $pedidos['purchase_units'][0]['shipping']['address']['address_line_1'];
            $ciudad = $pedidos['purchase_units'][0]['shipping']['address']['address_line_2'];
            $email_user = $_SESSION['correoCliente'];
            $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user);
            if ($data > 0) {
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data, $producto['idProducto']);
                    $mensaje = array('msg' => 'Registro de pedido exitoso', 'icono' => 'success');
                }
            } else {
                $mensaje = array('msg' => 'Error al registrar pedido', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }
    // función que permite listar pedidos pendientes
    public function listarPendientes()
    {
        $data = $this->model->getPedidos();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] = '<div class="text-center"><button class="btn btn-primary" type="button" onclick = "verpedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button></div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite ver los pedidos registrados
    public function verPedido($idPedido)
    {
        $data['pedido'] = $this->model->getPedido($idPedido);
        $data['productos'] = $this->model->verPedidos($idPedido);
        $data['moneda'] = MONEDA;
        echo json_encode($data);
        die();
    }
    // función que permite cerrar la sesión activa
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
}
