<?php
class Categorias extends Controller
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
        $data['title'] = 'Categorias';
        $this->views->getView('admin/categorias', "index", $data);
    }
    // función que obtiene los datos del listado de las categorías y añade acciones de eliminación y edición
    public function listar()
    {
        $data = $this->model->getCategorias(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['img'] = '<img class="img-thumbnail" src="' . $data[$i]['img'] . '" alt="" width = "50">';
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editCategoria(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="eliminarCategoria(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite registrar nuevas categorías
    public function registrar()
    {
        if (isset($_POST['categoria'])) {
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/img/categorias/';
            $nombreImg = date('YmdHis');
            if (empty($_POST['categoria'])) {
                $respuesta = array('msg' => 'Campos incompletos', 'icono' => 'warning');
            } else {
                if (!empty($imagen['name'])) {
                    $destino = $ruta . $nombreImg . '.jpg';
                } elseif (!empty($_POST['img_actual']) && empty($imagen['name'])) {
                    $destino = $_POST['img_actual'];
                } else {
                    $destino = $ruta . 'default.png';
                }
                if (empty($id)) {
                    $result = $this->model->verificarCategoria($categoria);
                    if (empty($result)) {
                        $data = $this->model->registrar($categoria, $destino);
                        if ($data > 0) {
                            if (!empty($imagen['name'])) {
                                move_uploaded_file($tmp_name, $destino);
                            }
                            $respuesta = array('msg' => 'Categoría registrada', 'icono' => 'success');
                        } else {
                            $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                        }
                    } else {
                        $respuesta = array('msg' => 'La categoría ya está registrada', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($categoria, $destino, $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Categoría actualizada', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error', 'icono' => 'warning');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    // función que permite eliminar categorías según su id
    public function delete($idCategoria)
    {
        if (is_numeric($idCategoria)) {
            $data = $this->model->eliminar($idCategoria);
            if ($data == 1) {
                $respuesta = array('msg' => 'Categoría eliminada', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    // función que permite editar categorías según su id
    public function edit($idCategoria)
    {
        if (is_numeric($idCategoria)) {
            $data = $this->model->getCategoria($idCategoria);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
