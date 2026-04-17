<?php
class ErrorView {
    public function renderError(string $error) {
        // el template error.php puede acceder a las mismas variables 
        // que tiene alcance en esta función, por ejemplo $error
        require_once __DIR__ . '/../../templates/error.php';
    }
}
