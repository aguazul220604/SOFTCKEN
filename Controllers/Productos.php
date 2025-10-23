<?php
class Productos extends Controller
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
        $data['title'] = 'Productos';
        $data['categorias'] = $this->model->getCategorias();
        $this->views->getView('admin/productos', "index", $data);
    }
    public function listar()
    {
        $data = $this->model->getProductos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['img'] = '<img class="img-thumbnail" src="' . $data[$i]['img'] . '" alt="" width = "50">';
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="editProducto(' . $data[$i]['id'] . ')"><i class="fas fa-edit"></i></button>
            <button class="btn btn-danger" type="button" onclick="eliminarProducto(' . $data[$i]['id'] . ')"><i class="fas fa-trash"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    public function registrar()
    {
        if (isset($_POST['nombre']) && isset($_POST['precio'])) {
            $nombre = $_POST['nombre'];
            $precio = $_POST['precio'];
            $cantidad = $_POST['cantidad'];
            $descripcion = $_POST['descripcion'];
            $categoria = $_POST['categoria'];
            $imagen = $_FILES['imagen'];
            $tmp_name = $imagen['tmp_name'];
            $id = $_POST['id'];
            $ruta = 'assets/img/';
            $nombreImg = date('YmdHis');
            if (empty($nombre) || empty($precio) || empty($cantidad)) {
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
                    $data = $this->model->registrar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria);
                    if ($data > 0) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Producto registrado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error al registrar', 'icono' => 'warning');
                    }
                } else {
                    $data = $this->model->modificar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id);
                    if ($data == 1) {
                        if (!empty($imagen['name'])) {
                            move_uploaded_file($tmp_name, $destino);
                        }
                        $respuesta = array('msg' => 'Producto actualizado', 'icono' => 'success');
                    } else {
                        $respuesta = array('msg' => 'Error', 'icono' => 'warning');
                    }
                }
            }
            echo json_encode($respuesta);
        }
        die();
    }
    public function delete($idProducto)
    {
        if (is_numeric($idProducto)) {
            $data = $this->model->eliminar($idProducto);
            if ($data == 1) {
                $respuesta = array('msg' => 'Producto eliminado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
        } else {
            $respuesta = array('msg' => 'Error desconocido', 'icono' => 'error');
        }
        echo json_encode($respuesta);
        die();
    }
    public function edit($idProducto)
    {
        if (is_numeric($idProducto)) {
            $data = $this->model->getProducto($idProducto);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        }
        die();
    }
}
