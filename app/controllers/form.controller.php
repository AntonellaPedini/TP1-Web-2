<?php
require_once __DIR__ . '/../models/form.model.php';
require_once __DIR__ . '/../views/error.view.php';

class FormController {
    private $model;
    private $errorView;

    public function __construct() {
        $this->model = new FormModel();
        $this->errorView = new ErrorView();
    }

    public function procesarLogin() {
        if (!isset($_POST['username']) || !isset($_POST['password'])) {
            return $this->errorView->renderError("Faltan datos para iniciar sesión. Por favor, complete los campos requeridos.");
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($this->model->validateCredentials($username, $password)) {
            header("Location: " . BASE_URL . "home");
        } else {
            return $this->errorView->renderError("Credenciales inválidas. Por favor, intente nuevamente.");
        }
    }
}