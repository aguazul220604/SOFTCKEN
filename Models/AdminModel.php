<?php
class AdminModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que obtiene datos del usuario según su correo
    public function getUsuario($correo)
    {
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        return $this->select($sql);
    }
    // función que retorna los pedidos totales según su estado
    public function getTotales($estado)
    {
        $sql = "SELECT COUNT(*) AS total FROM pedidos WHERE proceso = $estado";
        return $this->select($sql);
    }
    // función que retorna los productos según estén activos
    public function getProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos WHERE estado = 1";
        return $this->select($sql);
    }
    // función que retorna los productos activos con una mínima cantidad de disponibilidad
    public function productosMinimos()
    {
        $sql = "SELECT * FROM productos WHERE cantidad < 15 and estado = 1 ORDER BY cantidad DESC LIMIT 5";
        return $this->selectAll($sql);
    }
    // función que retorna los productos mayormente vendidos
    public function productosTop()
    {
        $sql = "SELECT producto, SUM(cantidad) AS total FROM detalle_pedido GROUP BY id_producto ORDER BY total DESC LIMIT 5";
        return $this->selectAll($sql);
    }
}
