<?php
class ShopModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    private $id_producto_actual;
    // función que relaciona productos con su categoría correspondiente a partir de su id
    public function getProducto($id_producto)
    {
        $this->id_producto_actual = $id_producto;
        $sql = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON p.id_categoria = c.id WHERE p.id = $id_producto";
        return $this->select($sql);
    }
    // función que retorna los productos relacionados a la categoría del producto seleccionado por el usuario
    public function getProductosRelacionados()
    {
        $sql = "SELECT * FROM productos WHERE id_categoria = (SELECT id_categoria FROM productos WHERE id = $this->id_producto_actual) AND id != $this->id_producto_actual";
        return $this->selectAll($sql);
    }
}
