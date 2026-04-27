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

    public function mostrarObrasTodas() {
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

    public function agregarObra (){
        if (
            !isset($_POST['nombre']) || !isset($_POST['anio']) ||
            !isset($_POST['tecnica']) || !isset($_POST['soporte']) ||
            !isset($_POST['corriente']) || !isset($_POST['descripcion']) || !isset($_POST['imagen']) || !isset($_POST['id_artista'])
        ){
            return $this->errorView->renderError("Faltan datos para agregar la obra");
        }

        $nombre = $_POST['nombre'];
        $anio = $_POST['anio'];
        $tecnica = $_POST['tecnica'];
        $soporte = $_POST['soporte'];
        $corriente = $_POST['corriente'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_POST['imagen'];
        $id_artista = $_POST['id_artista'];

        $id = $this->model->insert($nombre, $anio, $tecnica, $soporte, $corriente, $descripcion, $imagen, $id_artista);

        if (empty($id)) {
            return $this->errorView->renderError("No se pudo agregar la obra. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL . "obra/" . $id);
    }

    public function eliminarObra($id) {
        $obra = $this->model->get($id);

        if ($obra === null) {
            return $this->errorView->renderError("La obra no existe");
        }

        $filasEliminadas = $this->model->delete($id);

        if ($filasEliminadas === 0) {
            return $this->errorView->renderError("No se pudo eliminar la obra. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL);
    }
}


