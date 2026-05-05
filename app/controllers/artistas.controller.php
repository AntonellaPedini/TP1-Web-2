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

    public function mostrarArtista($name = null) { //ABM Lista de Categorías
        $ArtistasList = $this->model->getAll();
        
        $selectedArtista = null;
        $obras = [];
        if ($name !== null) {
            $selectedArtista = $this->model->getByName($name);
            if ($selectedArtista === null) {
                return $this->errorView->renderError("El artista buscado no existe");
            }
        $obras = $this->model->getObrasByArtista($selectedArtista->id_artista);
        }

        $this->view->renderArtista($ArtistasList, $selectedArtista, $obras);
    }

    private function getDatosArtista (){
        if (
            !isset($_POST['nombre_completo']) || !isset($_POST['fecha_nacimiento']) ||
            !isset($_POST['fecha_fallecimiento']) || !isset($_POST['corriente']) ||
            !isset($_POST['nacionalidad']) || !isset($_POST['biografia']) || !isset($_POST['imagen'])
            ){
        return null;
        }

    return [
        'nombre_completo'    => $_POST['nombre_completo'],
        'fecha_nacimiento'   => $_POST['fecha_nacimiento'],
        'fecha_fallecimiento'=> $_POST['fecha_fallecimiento'],
        'corriente'          => $_POST['corriente'],
        'nacionalidad'       => $_POST['nacionalidad'],
        'biografia'          => $_POST['biografia'],
        'imagen'             => $_POST['imagen'],
    ];
    }

    public function agregarArtista (){ //ABM Agregar Categoría
        $datos = $this->getDatosArtista();
        if ($datos === null){
            return $this->errorView->renderError("No se pudo agregar el artista. Por favor, intente otra vez.");
        }

        $id = $this->model->insert(...$datos); //El ... antes de un array es el spread operator de PHP, que desempaqueta el array como parámetros individuales, así no tenés que pasarlos uno por uno.

        header("Location: " . BASE_URL . "artistas"); //Redirige a la sección Artistas
    }

    public function eliminarArtista($id) { //ABM Eliminar Categoría
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

    public function editarArtista ($id_artista){ //ABM Editar Categoría
        $artista = $this->model->getById($id_artista);
        if ($artista === null) {
            return $this->errorView->renderError("El artista no existe");
        }

        $datos = $this->getDatosArtista();
        if ($datos === null) {
            return $this->errorView->renderError("Faltan datos para modificar el artista. Por favor, intente otra vez");
        }
        
        $datos['id_artista'] = $id_artista; //El id_artista va dentro del array y el spread operator lo desempaqueta todo junto en el orden correcto.
        $filasActualizadas = $this->model->update(...$datos);

        if ($filasActualizadas === 0) {
            return $this->errorView->renderError("No se pudo editar la información del artista. Por favor, intente otra vez.");
        }

        header("Location: " . BASE_URL . "artista/" . $id_artista);
    }
}
