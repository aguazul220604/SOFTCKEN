<?php
class Admin extends Controller
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
        $data['title'] = 'Acceso al sistema';
        $this->views->getView('admin', "login", $data);
    }
    // función que valida el acceso al sistema 
    public function validar()
    {
        if (isset($_POST['email']) && isset($_POST['clave'])) {
            if (empty($_POST['email']) || empty($_POST['clave'])) {
                $respuesta = array('msg' => 'Campos incompletos', 'icono' => 'warning');
            } else {
                $data = $this->model->getUsuario($_POST['email']);
                if (empty($data)) {
                    $respuesta = array('msg' => 'El correo no existe', 'icono' => 'warning');
                } else {
                    if (password_verify($_POST['clave'], $data['clave'])) {
                        $_SESSION['email'] = $data['correo'];
                        $_SESSION['nombre_usuario'] = $data['nombre'];
                        $respuesta = array('msg' => 'Bienvenido', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Contraseña incorrecta', 'icono' => 'warning');
                    }
                }
            }
        } else {
            $respuesta = array('msg' => 'Error fatal', 'icono' => 'error');
        }
        echo json_encode($respuesta, JSON_UNESCAPED_UNICODE);
        die();
    }
    // función que retorna los datos del estado de los productos
    public function home()
    {
        $data['title'] = 'Panel Administrativo';
        $data['pendientes'] = $this->model->getTotales(1);
        $data['proceso'] = $this->model->getTotales(2);
        $data['finalizados'] = $this->model->getTotales(3);
        $data['productos'] = $this->model->getProductos();

        $this->views->getView('admin/administracion', "index", $data);
    }
    // función que finaliza la sesión de usuario activa
    public function salir()
    {
        session_destroy();
        header('Location: ' . BASE_URL);
    }
    // función que recolecta los datos de los productos con disponibilidad mínima
    public function productosMinimos()
    {
        $data = $this->model->productosMinimos();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
    // función que recolecta los datos de los productos con mayor demanda
    public function productosTop()
    {
        $data = $this->model->productosTop();
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
