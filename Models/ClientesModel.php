<?php
class ClientesModel extends Query
{

  public function __construct()
  {
    parent::__construct();
  }
  // función que recibe parámetros de registro de usuarios
  public function registroDirecto($nombre, $correo, $clave, $token)
  {
    $sql = "INSERT INTO `clientes` (`nombre`, `correo`, `clave`, `token`) VALUES (?,?,?,?)";
    $datos = array($nombre, $correo, $clave, $token);
    $data = $this->insertar($sql, $datos);
    if ($data > 0) {
      $res = $data;
    } else {
      $res = 0;
    }
    return $res;
  }
  // función que actualiza el token de verificación del correo
  public function getToken($token)
  {
    $sql = "SELECT * FROM clientes WHERE token = '$token'";
    return $this->select($sql);
  }
  // función que actualiza el estado de verificación del correo
  public function actualizarVerify($id)
  {
    $sql = "UPDATE `clientes` SET token=?, verify=? WHERE id=?";
    $datos = array(null, 1, $id);
    $data = $this->save($sql, $datos);
    if ($data == 1) {
      $res = $data;
    } else {
      $res = 0;
    }
    return $res;
  }
  // función que verifica el correo de registro
  public function getVerificar($correo)
  {
    $sql = "SELECT * FROM clientes WHERE correo = '$correo'";
    return $this->select($sql);
  }
  // función que entrega los datos del pedido para realizar su registro
  public function registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user)
  {
    $sql = "INSERT INTO `pedidos` (`id_transaccion`, `monto`, `estado`, `fecha`, `email`, `nombre`, `apellido`, `direccion`, `ciudad`, `email_user`) VALUES (?,?,?,?,?,?,?,?,?,?)";
    $datos = array($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user);
    $data = $this->insertar($sql, $datos);
    if ($data > 0) {
      $res = $data;
    } else {
      $res = 0;
    }
    return $res;
  }
  // función que retorna los datos del producto según su id
  public function getProducto($id_producto)
  {
    $sql = "SELECT * FROM productos WHERE id = $id_producto";
    return $this->select($sql);
  }
  // función que entrega los detalles del pedido para realizar su registro
  public function registrarDetalle($producto, $precio, $cantidad, $id_pedido, $id_producto)
  {
    $sql = "INSERT INTO `detalle_pedido` (`producto`, `precio`, `cantidad`, `id_pedido`, `id_producto`) VALUES (?,?,?,?,?)";
    $datos = array($producto, $precio, $cantidad, $id_pedido, $id_producto);
    $data = $this->insertar($sql, $datos);
    if ($data > 0) {
      $res = $data;
    } else {
      $res = 0;
    }
    return $res;
  }
  //pedidos pendientes
  public function getPedidos()
  {
    $sql = "SELECT * FROM pedidos";
    return $this->selectAll($sql);
  }
  // función que obtiene los datos del pedido registrado a partir de su id
  public function getPedido($idPedido)
  {
    $sql = "SELECT * FROM pedidos WHERE id = $idPedido";
    return $this->select($sql);
  }
  // función que retorna los detalles del pedido según su id
  public function verPedidos($idPedido)
  {
    $sql = "SELECT d.* FROM pedidos p INNER JOIN detalle_pedido d ON p.id = d.id_pedido WHERE p.id = $idPedido";
    return $this->selectAll($sql);
  }
}
