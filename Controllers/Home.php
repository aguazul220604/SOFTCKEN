<?php
class Home extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
        session_start();
    }
    // función de la vista principal del controlador
    public function index()
    {
        $data['perfil'] = 'no';
        $data['title'] = 'Pagina Principal';
        $data['categorias'] = $this->model->getCategorias();
        $data['productos'] = $this->model->productos();
        $data['productos1'] = $this->model->productos1();
        $data['productos2'] = $this->model->productos2();
        $data['productos3'] = $this->model->productos3();
        $this->views->getView('home', "index", $data);
    }
}
