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

    public function mostrarObrasTodas() { //ABM Lista de Ítems
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

    private function getDatosObra(){
    if (
        !isset($_POST['nombre']) || !isset($_POST['anio']) ||
        !isset($_POST['tecnica']) || !isset($_POST['soporte']) ||
        !isset($_POST['corriente']) || !isset($_POST['descripcion']) || !isset($_POST['imagen']) || !isset($_POST['id_artista'])
        ){
        return null;
    }

    return [
        'nombre' => $_POST['nombre'],
        'anio' => $_POST['anio'],
        'tecnica' => $_POST['tecnica'],
        'soporte' => $_POST['soporte'],
        'corriente' => $_POST['corriente'],
        'descripcion' => $_POST['descripcion'],
        'imagen' => $_POST['imagen'],
        'id_artista' => $_POST['id_artista'],
    ];
    }
    
    public function formularioAgregarObra() {
        $artistas = $this->model->getAll();
        $this->view->renderAgregarObra($artistas);
    }

    public function agregarObra (){ //ABM Agregar Items
        $datosObra = $this->getDatosObra();
        if ($datosObra === null){
            return $this->errorView->renderError("Faltan datos para agregar la obra");
        }

        $id = $this->model->insert(...$datosObra);

        if (empty($id)) {
            return $this->errorView->renderError("No se pudo agregar la obra. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL . "obra/" . $id);
    }

    public function eliminarObra($id) { //ABM Eliminar Ítems
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

    public function editarObra($id) { //ABM Editar Ítems
        $datosObra = $this->getDatosObra();

        if ($datosObra === null) {
            return $this->errorView->renderError("La obra no existe");
        }

        $filasActualizadas = $this->model->update(...$datosObra);

        if ($filasActualizadas === 0) {
            return $this->errorView->renderError("No se pudo editar la obra. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL . "obra/" . $id);
    }

}


