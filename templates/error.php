<?php require_once './templates/header.php' ?>

<main class="container">
    <div class="alert alert-danger my-4" role="alert">
    <h4 class="alert-heading">Error!</h4>
    <p><?= $error ?? 'Ocurrió un error inesperado.' ?></p>
    <hr>
        <a href="home" class="btn btn-primary">Volver al inicio</a>
    </div>
</main>

<?php require_once './templates/footer.php' ?>
