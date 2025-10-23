<?php
class Errors extends Controller
{
    // constructor del controlador 
    public function __construct()
    {
        parent::__construct();
    }
    // función de la vista principal del controlador
    public function index()
    {
        $this->views->getView('errors', "index");
    }
}
