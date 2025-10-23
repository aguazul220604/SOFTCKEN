<?php
class UsuariosModel extends Query
{

    public function __construct()
    {
        parent::__construct();
    }
    // función que retorna una selección de usuarios según su estado activo
    public function getUsuarios($estado)
    {
        $sql = "SELECT id, nombre, apellido, correo, perfil FROM usuarios WHERE estado = $estado";
        return $this->selectAll($sql);
    }
    // función que retorna una inserción de datos al crear un nuevo registro
    public function registrar($nombre, $apellido, $correo, $clave)
    {
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, clave) VALUES (?,?,?,?)";
        $array = array($nombre, $apellido, $correo, $clave);
        return $this->insertar($sql, $array);
    }
    // función que retorna una verificación del correo de registro
    public function verificarCorreo($correo)
    {
        $sql = "SELECT correo FROM usuarios WHERE correo = '$correo' AND estado = 1";
        return $this->select($sql);
    }
    // función que retorna la eliminación de usuarios al modificar su estado a inactivo
    public function eliminar($idUser)
    {
        $sql = "UPDATE usuarios SET estado = ? WHERE id = ?";
        $array = array(0, $idUser);
        return $this->save($sql, $array);
    }
    // función que retorna los datos de usurio según su id
    public function getUsuario($idUser)
    {
        $sql = "SELECT id, nombre, apellido, correo FROM usuarios WHERE id = $idUser";
        return $this->select($sql);
    }
    // función que retorna una actualización de datos segun el id del usuario
    public function modificar($nombre, $apellido, $correo, $id)
    {
        $sql = "UPDATE usuarios SET nombre = ?, apellido = ?, correo = ? WHERE id = ?";
        $array = array($nombre, $apellido, $correo, $id);
        return $this->save($sql, $array);
    }
}
