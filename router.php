<?php
require_once __DIR__ . '/app/controllers/obras.controller.php';
require_once __DIR__ . '/app/controllers/artistas.controller.php';
require_once __DIR__ . '/app/controllers/home.controller.php';
require_once __DIR__ . '/app/controllers/auth.controller.php';
require_once __DIR__ . '/app/middlewares/session.middleware.php';
require_once __DIR__ . '/app/middlewares/guard.middleware.php';

session_start();

// define la base URL del sitio
define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

/**  TABLA DE RUTEO
* /home             ->   HomeController::home()
* /obra             -> ObrasController::mostrarObrasTodas()
* /obras/:ID        ->   ObrasController::mostrarObra($id)
* /artista          ->   ArtistasController::mostrarArtista($name = null)
* /artistas/:NAME   ->   ArtistasController::mostrarArtista($name)
* /login_form       ->   AuthController::showForm($req)
* /login            ->   AuthController::login($req)
* /logout           -> AuthController::logout($req)
* /addItem          -> ObrasController::agregarObra($req)
* /addCategory      -> ArtistasController::agregarArtista($req)
* /deleteItem       -> ObrasController::eliminarObra($id)
* /deleteCategory   -> ArtistasController::eliminarArtista($id)
* /updateItem       -> ObrasController::editarObra($id)
* /updateCategory   ->ArtistasController::editarArtista($id_artista) /**/

// accion por default
$action = 'home';

// leo la accion que viene por parámetro
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

// parsea la accion Ej: staff/juan --> ['staff', juan]
$params = explode('/', $action);

$req = new stdClass();
$req = (new SessionMiddleware())->run($req); // Ejecuta el middleware de autenticación para verificar si el usuario está autenticado

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

    case 'obraId':
        $id = $params[1] ?? null;
        $obrasController = new ObrasController();
        $obrasController->mostrarObra($id);
        break;

    case 'login_form':
        $authController = new AuthController();
        $authController->showForm($req);
        break;

    case 'login':
        $authController = new AuthController();
        $authController->login($req);
        break;

    case 'logout':
        $authController = new AuthController();
        $authController-> logout($req);
        break;

    case 'addItem':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ObrasController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->agregarObra($req);
        } else {
            $controller->formularioAgregarObra();
        }
        break;

    case 'AddCategory':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ArtistasController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $controller->agregarArtista($req);
        } else {
            $controller->formularioAgregarArtista();
        }
        break;

    case 'deleteItem':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ObrasController();
        $controller->eliminarObra($params[1]);
        break;

    case 'deleteCategory':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ArtistasController();
        $controller->eliminarArtista($params[1]);
        break;

    case 'updateItem':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ObrasController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->editarObra($params[1]);
        } else {
            $controller->formularioEditarObra($params[1]);
        }
        break;
    
    case 'updateCategory':
        $req = (new GuardMiddleware()) ->run($req);
        $controller = new ArtistasController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->editarArtista($params[1]);
        } else {
            $controller->formularioEditarArtista($params[1]);
        }
        break;

    default:
        echo '404 error';
        break;
}

