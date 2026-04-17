<?php
require_once __DIR__ . '/app/controllers/obras.controller.php';
require_once __DIR__ . '/app/controllers/artistas.controller.php';

// define la base URL del sitio
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

/**  TABLA DE RUTEO                             
 *   /home          ->   ObrasController::home()     
 *   /noticia/:ID   ->   ObrasController::show($id)   
 *   /staff         ->   ArtistasController::index()       
 *   /staff/:NAME   ->   ArtistasController::index($name)
 **/

// accion por default
$action = 'home';

// leo la accion que viene por parámetro
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: staff/juan --> ['staff', juan]
$params = explode('/', $action);

// rutea según la acción
switch ($params[0]) {
    case 'home':
        $obrasController = new ObrasController();
        $obrasController->home();
        break;
    case 'obra':
        $id = $params[1] ?? null;
        $obrasController = new ObrasController();
        $obrasController->mostrarObra($id);
        break;
    case 'artista':
        $name = $params[1] ?? null;
        $ArtistaController = new ArtistaController();
        $ArtistaController->mostrarArtista($name);
        break;
    default:
        echo '404 error';
        break;
}

