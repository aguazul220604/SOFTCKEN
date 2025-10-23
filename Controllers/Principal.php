<?php
class Principal extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    // función de la vista principal del controlador
    public function about()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Contacto';
        $this->views->getView('principal', "contact", $data);
    }
    // función que permite realizar la paginación del menú
    public function shop($page)
    {
        $data['perfil'] = 'no';
        $pagina = (empty($page)) ? 1 : $page;
        $porPagina = 6;
        $desde = ($pagina - 1) * $porPagina;
        $data['title'] = 'Menú de productos';
        $data['productos'] = $this->model->getProductos($desde, $porPagina);

        $data['productos1'] = $this->model->getProductos1($desde, $porPagina);
        $data['productos2'] = $this->model->getProductos2($desde, $porPagina);
        $data['productos3'] = $this->model->getProductos3($desde, $porPagina);
        $data['productos4'] = $this->model->getProductos4($desde, $porPagina);

        $data['pagina'] = $pagina;
        $total = $this->model->totalProductos();
        $data['total'] = ceil($total['total'] / $porPagina);
        $this->views->getView('principal', "shop", $data);
    }
    // función que permite acceder a la vista de opiniones
    public function opiniones()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Opiniones';
        $this->views->getView('principal', "testimonial", $data);
    }
    // función que permite acceder a la vista de productos
    public function producto()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Tu lista de productos';
        $this->views->getView('principal', "producto", $data);
    }
    // función que permite realizar un listado de los productos añadidos al carrito por el usuario

    public function listaProducto()
    {
        $datos = file_get_contents('php://input');
        $json = json_decode($datos, true);
        $array['productos'] = array();
        $total = 0.00;
        if (!empty($json)) {
            foreach ($json as $producto) {
                $result = $this->model->getProducto($producto['idProducto']);

                $data['id'] = $result['id'];
                $data['nombre'] = $result['nombre'];
                $data['precio'] = $result['precio'];
                $data['nombre'] = $result['nombre'];
                $data['cantidad'] = $producto['cantidad'];
                $data['img'] = $result['img'];
                
                $subtotal = $result['precio'] * $producto['cantidad'];
                $data['subtotal'] = number_format($subtotal, 2);
                array_push($array['productos'], $data);
                $total += $subtotal;
            }
        }
        $array['total'] = number_format($total, 2);
        $array['totalPaypal'] = number_format($total, 2, '.', '');
        $array['moneda'] = MONEDA;
        echo json_encode($array, JSON_UNESCAPED_UNICODE);
        die();
    }
    // función que permite realizar búsqueda de productos
    public function busqueda($valor)
    {
        $data = $this->model->getBusqueda($valor);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }
}
