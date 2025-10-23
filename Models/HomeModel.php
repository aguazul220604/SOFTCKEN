<?php
class HomeModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna los datos de las categorías
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias";
        return $this->selectAll($sql);
    }
    // función que retorna los datos de los productos según su estado activo
    public function productos()
    {
        $sql = "SELECT * FROM productos WHERE estado = 1";
        return $this->selectAll($sql);
    }
    // función que retorna los datos de los productos según su estado activo y el tipo de categoría 1
    public function productos1()
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = 1 AND estado = 1";
        return $this->selectAll($sql);
    }
    // función que retorna los datos de los productos según su estado activo y el tipo de categoría 2
    public function productos2()
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = 2 AND estado = 1";
        return $this->selectAll($sql);
    }
    // función que retorna los datos de los productos según su estado activo y el tipo de categoría 3
    public function productos3()
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = 3 AND estado = 1";
        return $this->selectAll($sql);
    }
}
