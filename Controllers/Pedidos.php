<?php
class Pedidos extends Controller
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
        $data['title'] = 'Pedidos';
        $this->views->getView('admin/pedidos', "index", $data);
    }
    // función que permite listar los pedidos y asignar acciones de visualización y editar estado
    public function listarPedidos()
    {
        $data = $this->model->getPedidos(1);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            <button class="btn btn-primary" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 2)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite listar los pedidos registrados en proceso 
    public function listarProceso()
    {
        $data = $this->model->getPedidos(2);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            <button class="btn btn-primary" type="button" onclick="cambiarProceso(' . $data[$i]['id'] . ', 3)"><i class="fas fa-check-circle"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite listar los pedidos registrados finalizados
    public function listarFinalizados()
    {
        $data = $this->model->getPedidos(3);
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['accion'] =
                '<div class="d-flex">
            <button class="btn btn-primary" type="button" onclick="verPedido(' . $data[$i]['id'] . ')"><i class="fas fa-eye"></i></button>
            </div>';
        }
        echo json_encode($data);
        die();
    }
    // función que permite actualizar el estado de los pedidos
    public function update($datos)
    {
        $array = explode(',', $datos);
        $idPedido = $array[0];
        $proceso = $array[1];
        if (is_numeric($idPedido)) {
            $data = $this->model->actualizarEstado($proceso, $idPedido);
            if ($data == 1) {
                $respuesta = array('msg' => 'Pedido actualizado', 'icono' => 'success');
            } else {
                $respuesta = array('msg' => 'Error al eliminar', 'icono' => 'warning');
            }
            echo json_encode($respuesta);
        }
        die();
    }
}
