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

    public function agregarArtista (){
        if (
            !isset($_POST['nombre_completo']) || !isset($_POST['fecha_nacimiento']) ||
            !isset($_POST['fecha_fallecimiento']) || !isset($_POST['corriente']) ||
            !isset($_POST['nacionalidad']) || !isset($_POST['biografia']) || !isset($_POST['imagen'])
        ){
            return $this->errorView->renderError("Faltan datos para agregar el artista. Por favor, complete los campos requeridos.");
        }

        $nombre_completo = $_POST['nombre_completo'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $fecha_fallecimiento = $_POST['fecha_fallecimiento'];
        $corriente = $_POST['corriente'];
        $nacionalidad = $_POST['nacionalidad'];
        $biografia = $_POST['biografia'];
        $imagen = $_POST['imagen'];

        $id = $this->model->insert($nombre_completo, $fecha_nacimiento, $fecha_fallecimiento, $corriente, $nacionalidad, $biografia, $imagen);

        if (empty($id)) {
            return $this->errorView->renderError("No se pudo agregar el artista. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL . "artistas/" . $id);
    }

    public function eliminarArtista($id) {
        $artista = $this->model->delete($id);

        if ($artista === null) {
            return $this->errorView->renderError("El artista no existe");
        }

        $filasEliminadas = $this->model->delete($id);

        if ($filasEliminadas === 0) {
            return $this->errorView->renderError("No se pudo eliminar al artista. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL);
    }
}
