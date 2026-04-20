<?php
require_once __DIR__ . '/../models/artistas.model.php';
require_once __DIR__ . '/../views/artistas.view.php';
require_once __DIR__ . '/../views/error.view.php';

class ArtistasController {
    private $model;
    private $view;
    private $errorView;

    public function __construct() {
        $this->model = new ArtistasModel();
        $this->view = new ArtistasView();
        $this->errorView = new ErrorView();
    }

    public function mostrarArtista($name = null) {
        $ArtistasList = $this->model->getAll();
        
        $selectedArtista = null;
        if ($name !== null) {
            $selectedArtista = $this->model->getByName($name);
            if ($selectedArtista === null) {
                 return $this->errorView->renderError("El artista buscado no existe");
            }
        }

        $this->view->renderArtista($ArtistasList, $selectedArtista);
    }
}
