<?php
class CategoriasModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna las categorías activas
    public function getCategorias($estado)
    {
        $sql = "SELECT * FROM categorias WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    // función que recibe la categoria e imagen para insertar datos en la creación de categorías
    public function registrar($categoria, $img)
    {
        $sql = "INSERT INTO categorias (categoria, img) VALUES (?,?)";
        $array = array($categoria, $img);
        return $this->insertar($sql, $array);
    }
    // función que retorna las categorías que están activas
    public function verificarCategoria($categoria)
    {
        $sql = "SELECT categoria FROM categorias WHERE categoria = '$categoria' AND estado = 1";
        return $this->select($sql);
    }
    // función que elimina categorías y recibe como parámetro el id de la misma
    public function eliminar($idCategoria)
    {
        $sql = "UPDATE categorias SET estado = ? WHERE id = ?";
        $array = array(0, $idCategoria);
        return $this->save($sql, $array);
    }
    // función que retorna los datos de categoría que se pasan por el parámetro
    public function getCategoria($idCategoria)
    {
        $sql = "SELECT * FROM categorias WHERE id = $idCategoria";
        return $this->select($sql);
    }
    // función que realiza actualizaciones de categorías  y recibe como parámetros la misma, su img y el id
    public function modificar($categoria, $img, $id)
    {
        $sql = "UPDATE categorias SET categoria = ?, img = ? WHERE id = ?";
        $array = array($categoria, $img, $id);
        return $this->save($sql, $array);
    }
}
