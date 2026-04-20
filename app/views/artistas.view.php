<?php
class ArtistasView {
    public function renderArtista($ArtistasList, $selectedArtista = null) {
        require_once __DIR__ . '/../../templates/header.php';
        ?>
        <main class="container mt-5">
            <section class="artista">
                <h1>Artistas Historicos y Contemporaneos</h1>
                <div class="row">
                    <div class="col-md-3">
                        <ul class="list-group">
                            <?php foreach ($ArtistasList as $Artista) { ?>
                                <li class="list-group-item">
                                    <a href="artista/<?= urlencode($Artista->nombre_completo) ?>" class="text-decoration-none">
                                        <?= $Artista->nombre_completo ?>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="col-md-9">
                        <?php if ($selectedArtista): ?>
                            <div class="card">
                                <div class="card-body text-center">
                                    <img src="<?= $selectedArtista->imagen ?>" class="rounded-circle mb-3" alt="Retrato o imagen del artista">
                                    <h5 class="card-title"><?= $selectedArtista->nombre_completo ?></h5>
                                    <p class="card-text">Corriente artística: <?= $selectedArtista->corriente_artistica ?></p>
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
