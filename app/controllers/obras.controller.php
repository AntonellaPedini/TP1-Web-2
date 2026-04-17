<?php
require_once __DIR__ . '/../models/obras.model.php';
require_once __DIR__ . '/../views/obras.view.php';
require_once __DIR__ . '/../views/error.view.php';

class ObrasController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new ObrasModel();
        $this->view = new ObrasView();
        $this->errorView = new ErrorView();
    }

    public function home() {
        // obtiene todas las obras de arte
        $obras = $this->model->getAll();

        // se las pasa a la vista para mostrarlas
        $this->view->renderHome($obras);
    }

    public function mostrarObra($id) {
        $obra = $this->model->get($id);

        if ($obra === null) {
            return $this->errorView->renderError("La obra no existe");
        }

        $this->view->renderObra($obra);
    }
}
