<?php
class PrincipalModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna datos del producto y su categoría segun su id
    public function getProducto($id_producto)
    {
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id_producto";
        return $this->select($sql);
    }
    // función que retorna datos de los productos según su paginación 
    public function getProductos($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE estado = 1 LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    // funciones que retorna datos de los productos según su paginación y categoría
    public function getProductos1($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE estado = 1 AND id_categoria = 2 LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    public function getProductos2($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE estado = 1 AND id_categoria = 2 LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    public function getProductos3($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE estado = 1 AND id_categoria = 2 LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    public function getProductos4($desde, $porPagina)
    {
        $sql = "SELECT * FROM productos WHERE estado = 1 AND id_categoria = 2 LIMIT $desde, $porPagina";
        return $this->selectAll($sql);
    }
    // función que retorna un total de los productos registrados
    public function totalProductos()
    {
        $sql = "SELECT COUNT(*) AS total FROM productos";
        return $this->select($sql);
    }
    // función que retorna resultados de búsqueda según los detalles del nombre en el rango like
    public function getBusqueda($valor)
    {

        $sql = "SELECT * FROM productos WHERE nombre LIKE '%" . $valor . "%' OR descripcion LIKE '%" . $valor . "%' LIMIT 4";
        return $this->selectAll($sql);
    }
}
