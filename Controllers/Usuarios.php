<?php
class Usuarios extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    public function index()
    {
        $data['title'] = 'Usuarios';
        $this->views->getView('admin/usuarios', "index", $data);
    }
    // función que obtiene un listado de los datos del servidor sobre usuarios
    public function listar()
    {
        $data = $this->model->getUsuarios(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editUser(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="eliminarUsuario(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite realizar registros de usuarios
    public function registrar()
    {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $clave = $_POST['clave'];
            $id = $_POST['id'];
            $hash = password_hash($clave, PASSWORD_DEFAULT);

            if (empty($_POST['nombre']) || empty($_POST['apellido'])) {
                $respuesta = array('msg' => 'Campos incompletos', 'icono' => 'warning');
            } else {
                if (empty($id)) {
                    $result = $this->model->verificarCorreo($correo);
                    if (empty($result)) {
                        $data = $this->model->registrar($nombre, $apellido, $correo, $hash);
                        if ($data > 0) {
                            $respuesta = array('msg' => 'Usuario registrado', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                        }
                    } else {
                        $respuesta = array('msg' => 'El correo ya está registrado', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($nombre, $apellido, $correo, $id);
                    if ($data == 1) {
                        $respuesta = array('msg' => 'Registro actualizado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error', 'icono' => 'warning');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    // función que permite eliminar registros de usuarios
    public function delete($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->eliminar($idUser);
            if ($data == 1) {
                $respuesta = array('msg' => 'Usuario eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    // función quepermite editar registros de usuarios
    public function edit($idUser)
    {
        if (is_numeric($idUser)) {
            $data = $this->model->getUsuario($idUser);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
