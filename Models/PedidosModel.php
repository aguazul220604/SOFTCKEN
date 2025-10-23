<?php
class PedidosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna los datos del producto según su proceso
    public function getPedidos($proceso)
    {
        $sql = "SELECT * FROM pedidos WHERE proceso = $proceso";
        return $this->selectAll($sql);
    }
    // función que devuelve el estado actualizado de los pedidos
    public function actualizarEstado($proceso, $idPedido)
    {
        $sql = "UPDATE pedidos SET proceso = ? WHERE id = ?";
        $array = array($proceso, $idPedido);
        return $this->save($sql, $array);
    }
}
