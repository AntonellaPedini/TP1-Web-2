<?php
require_once __DIR__ . '/../models/home.model.php';
require_once __DIR__ . '/../views/home.view.phtml';
require_once __DIR__ . '/../views/error.view.php';

class HomeController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new HomeModel();
        $this->view = new HomeView();
        $this->errorView = new HomeView();
    }

public function home() {
    $obras = $this->model->getAll();

    // imágenes para el carrusel
    $imagenesCarrusel = $this->model->getImagenesCarrusel();

    $this->view->renderHome($obras, $imagenesCarrusel);
}

}