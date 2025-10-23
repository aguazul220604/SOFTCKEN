<?php
class ProductosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna productos activos
    public function getProductos($estado)
    {
        $sql = "SELECT * FROM productos WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    // función que retorna prodctos según su categoría
    public function getCategorias()
    {
        $sql = "SELECT * FROM categorias WHERE estado = 1";
        return $this->selectAll($sql);
    }
    // función que registra nuevos productos
    public function registrar($nombre, $descripcion, $precio, $cantidad, $img, $categoria)
    {
        $sql = "INSERT INTO productos (nombre, descripcion, precio, cantidad, img, id_categoria) VALUES (?,?,?,?,?,?)";
        $array = array($nombre, $descripcion, $precio, $cantidad, $img, $categoria);
        return $this->insertar($sql, $array);
    }
    // función que elimina productos según su id
    public function eliminar($idProducto)
    {
        $sql = "UPDATE productos SET estado = ? WHERE id = ?";
        $array = array(0, $idProducto);
        return $this->save($sql, $array);
    }
    // función que retorna los datos de producto según su id
    public function getProducto($idProducto)
    {
        $sql = "SELECT * FROM productos WHERE id = $idProducto";
        return $this->select($sql);
    }
    // función que realiza modificaciones o actualizaciones a los productos
    public function modificar($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id)
    {
        $sql = "UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, cantidad = ?, img = ?, id_categoria = ? WHERE id = ?";
        $array = array($nombre, $descripcion, $precio, $cantidad, $destino, $categoria, $id);
        return $this->save($sql, $array);
    }
}
