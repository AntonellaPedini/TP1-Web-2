<?php
class ArtistasView
{
    public function renderArtista($ArtistasList, $selectedArtista = null, $obras = [])
    {
        require_once __DIR__ . '/templates/layout/header.phtml';
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

                                    <?php if (isset($_SESSION['id_usuario'])): ?>
                                        <a href="<?= BASE_URL ?>?action=updateCategory/<?= $selectedArtista->id_artista ?>" class="botonesObra">Editar</a>
                                        <a href="<?= BASE_URL ?>?action=deleteCategory/<?= $selectedArtista->id_artista ?>"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar el artista?');"
                                            class="botonesObra">Eliminar</a>
                                    <?php endif; ?>

                                    <p class="card-text"><?= $selectedArtista->nacionalidad ?> (<?= $selectedArtista->fecha_nacimiento ?> · <?= $selectedArtista->fecha_fallecimiento ?>)</p>
                                    <p class="card-text">Corriente artística: <?= $selectedArtista->corriente_artistica ?></p>
                                    <p class="card-text"><?= $selectedArtista->biografia ?></p>
                                    <ul>
                                        <h5>Obras destacadas:</h5>
                                        <?php foreach ($obras as $obra) { ?>
                                            <li>
                                                <a href="obraId/<?= $obra->id_obra ?>" class="text-decoration-none">
                                                    <?= $obra->nombre ?> (<?= $obra->año_creacion ?>)
                                                </a>
                                            </li>
                                        <?php } ?>
                                    </ul>



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
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function renderFormularioArtistas($artista = null) {
        $esEdicion = $artista !== null;
        $action = $esEdicion ? "updateCategory/{$artista->id_artista}" : "AddCategory";
        require_once __DIR__ . '/templates/layout/header.phtml';
    ?>
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?= $esEdicion ? 'Editar artista' : 'Nuevo artista' ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>?action=<?= $action ?>">
                    <div class="mb-3">
                        <label for="nombre_completo" class="form-label">Nombre completo<span class="text-danger">*</span></label>
                        <input required id="nombre_completo" name="nombre_completo" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->nombre_completo) : '' ?>"
                            placeholder="Nombre del/a artista">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento <span class="text-danger">*</span></label>
                        <input required id="fecha_nacimiento" name="fecha_nacimiento" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->fecha_nacimiento) : '' ?>"
                            placeholder="Fecha de nacimiento">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_fallecimiento" class="form-label">Fecha de fallecimiento</label>
                        <input id="fecha_fallecimiento" name="fecha_fallecimiento" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->fecha_fallecimiento) : '' ?>"
                            placeholder="Fecha de fallecimiento">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="corriente_artistica" class="form-label">Corriente artística<span class="text-danger">*</span></label>
                        <input required id="corriente_artistica" name="corriente_artistica" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->corriente_artistica) : '' ?>"
                            placeholder="Ingrese la corriente artística">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nacionalidad" class="form-label">Nacionalidad<span class="text-danger">*</span></label>
                        <input required id="nacionalidad" name="nacionalidad" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->nacionalidad) : '' ?>"
                            placeholder="Ingrese la nacionalidad del artista">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="biografia" class="form-label">Biografía<span class="text-danger">*</span></label>
                        <textarea required id="biografia" name="biografia" class="form-control"
                            placeholder="Ingrese una breve biografía del artista"><?= $esEdicion ? htmlspecialchars($artista->biografia) : '' ?></textarea>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="imagen" class="form-label">Imagen</label>
                        <input id="imagen" name="imagen" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($artista->imagen) : '' ?>"
                            placeholder="Ingrese la URL de la imagen del artista">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><?= $esEdicion ? 'Guardar cambios' : 'Guardar artista' ?></button>
                        <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }
}
