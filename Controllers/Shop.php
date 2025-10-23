<?php
class Shop extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    // función que devuelve los datos obtenidos en el controlador y redirije a las vistas
    public function details($id_producto)
    {
        $data['perfil'] = 'no';
        $data['producto'] = $this->model->getProducto($id_producto);
        $data['productos'] = $this->model->getProductosRelacionados();
        $data['title'] = $data['producto']['nombre'];
        $this->views->getView('principal', "shop-detail", $data);
    }
}
