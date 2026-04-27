<?php
require_once __DIR__ . '/app/controllers/obras.controller.php';
require_once __DIR__ . '/app/controllers/artistas.controller.php';
require_once __DIR__ . '/app/controllers/home.controller.php';

// define la base URL del sitio
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

/**  TABLA DE RUTEO
 *   /home          ->   ObrasController::home()
 *   /obras/:ID   ->   ObrasController::mostrarObra($id)
 *   /artistas        ->   ArtistasController::mostrarArtista($name = null)
 *   /artistas/:NAME   ->   ArtistasController::index($nombre_completo)
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
        $HomeController = new HomeController();
        $HomeController->home();
        break;
    case 'obra':
        $id = $params[1] ?? null;
        $obrasController = new ObrasController();
        $obrasController->mostrarObrasTodas();
        break;
    case 'artista':
        $name = $params[1] ?? null;
        $ArtistaController = new ArtistasController();
        $ArtistaController->mostrarArtista($name);
        break;
    default:
        echo '404 error';
        break;
}

