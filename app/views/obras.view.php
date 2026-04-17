<?php
class ObrasView {
    public function renderHome($obras) {
        require_once __DIR__ . '/../../templates/header.php';
        ?>
        <main class="container mt-5">
            <section class="obras">
                <?php foreach ($obras as $key => $obra) { ?>
                    <div class="card">
                        <img src="<?= $obra->imagen ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $obra->nombre ?></h5>
                            <a href="noticia/<?= $obra->id_obra ?>" class="btn btn-outline-primary">Leer más</a>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </main>
        <?php
        require_once __DIR__ . '/../../templates/footer.php';
    }

    public function renderObra($obra) {
        require_once __DIR__ . '/../../templates/header.php';
        ?>
        <main class="container mt-5">
            <section class="obra">
                <h1 class="mb-5"><?= $obra->nombre?></h1>
                <img class="obra-image" src="<?= $obra->imagen ?>" alt="Imagen de obra de arte">
                <p class="lead mt-3"><?= $obra-> descripcion ?></p>
            </section>
        </main>
        <?php
        require_once __DIR__ . '/../../templates/footer.php';
    }
}
