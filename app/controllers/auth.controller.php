<?php
require_once __DIR__ . '/../models/usuarios.model.php';
require_once __DIR__ . '/../views/auth.view.php';
require_once __DIR__ . '/../views/error.view.php';

class AuthController {
    private $view;
    private $model;
    private $errorView;
    
    public function __construct() {
        $this->model = new usuariosModel();
        $this->view = new AuthView();
        $this->errorView = new ErrorView();
    }
    
    public function showForm($req){
        $this->view->showForm();
    }

    public function login($req){
        if(empty($_POST["email"]) || empty($_POST["password"]))
            return $this->view->showForm();

        $email = $_POST["email"];
        $password = $_POST["password"];

        $usuario = $this->model->getByEmail($email);

        if(!$usuario) {
            return $this->errorView->renderError("Usuario o contraseña incorrecta");
        }

        if(!password_verify($password, $usuario->password)) {
            return $this->errorView->renderError("Usuario o contraseña incorrecta");
        }

        $_SESSION["id_usuario"] = $usuario->id_usuario;
        $_SESSION["email"] = $usuario->email;

        header("Location: ". BASE_URL);
    }

    public function logout($req){
        session_destroy();
        header("Location: " . BASE_URL);
    }
}
