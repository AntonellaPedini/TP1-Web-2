<?php

class AuthView {
    protected $user;

    public function setUser($user) {
        $this->user = $user;
    }

    public function showForm() {
        require_once __DIR__ . '/templates/login_form.phtml';
    }
}