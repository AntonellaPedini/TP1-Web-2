<?php
class ArtistaView {
    public function renderArtista($ArtistaList, $selectedArtista = null) {
        require_once __DIR__ . '/../../templates/header.php';
        ?>
        <main class="container mt-5">
            <section class="artista">
                <h1>Artistas Historicos y Contemporaneos</h1>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <?php foreach ($ArtistaList as $Artista) { ?>
                                <li class="list-group-item">
                                    <a href="artista/<?= urlencode($Artista->nombre) ?>" class="text-decoration-none">
                                        <?= $Artista->nombre ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <?php if ($selectedArtista): ?>
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($selectedArtista->nombre) ?>&size=80" class="rounded-circle mb-3" alt="Retrato o imagen del artista">
                                    <h5 class="card-title"><?= $selectedArtista->nombre ?></h5>
                                    <p class="card-text">Rol: <?= $selectedArtista->rol ?></p> /*MODIFICAR*/ 
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="text-muted">Selecciona un artista para conocer mas.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        </main>
        <?php
        require_once __DIR__ . '/../../templates/footer.php';
    }
}
