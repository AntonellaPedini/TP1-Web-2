<?php
class ObrasView
{
    public function renderHome($obras)
    {
        require_once __DIR__ . '/templates/layout/header.phtml';
?>
        <main class="container mt-5">
            <section class="obras">
                <?php foreach ($obras as $key => $obra) { ?>
                    <div class="card">
                        <img src="<?= $obra->imagen ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $obra->nombre ?></h5>
                            <a href="obraId/<?= $obra->id_obra ?>" class="btn btn-outline-primary">Leer más</a>
                        </div>
                    </div>
                <?php } ?>
            </section>
        </main>
    <?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }

    public function renderObra($obra)
    {
        require_once __DIR__ . '/templates/layout/header.phtml';
    ?>

        <main class="obra-container">
            <img class="obra-imagen" src="<?= $obra->imagen ?>" alt="<?= $obra->nombre ?>">

            <div class="obra-contenido">
                <section class="obra">
                    <h1 class="mb-5"><?= $obra->nombre ?></h1>
                    <h3><a href="artista/<?= urlencode($obra->nombre_completo) ?>"><?= $obra->nombre_completo ?></a></h3> <!--urlencode() convierte un texto para que sea válido dentro de una URL.-->
                    <h4><?= $obra->año_creacion ?></h4>
                    <h4><?= $obra->tecnica ?> sobre <?= $obra->soporte ?></h4>
                    <h4><?= $obra->corriente_artistica ?></h4>
                    <p class="lead mt-3"><?= $obra->descripcion ?></p>

                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <a href="updateItem/<?= $obra->id_obra ?>" class="botonesObra">Editar</a>
                        <a href="deleteItem/<?= $obra->id_obra ?>"
                            onclick="return confirm('¿Estás seguro de que deseas eliminar esta obra?');"
                            class="botonesObra">Eliminar</a>
                    <?php endif; ?>

                </section>
            </div>
        </main>
    <?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }


    public function renderFormularioObra($artistas, $obra = null){
        $esEdicion = $obra !== null;
        $action = $esEdicion ? "updateItem/{$obra->id_obra}" : "addItem";
        require_once __DIR__ . '/templates/layout/header.phtml';
    ?>
        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?= $esEdicion ? 'Editar obra' : 'Nueva obra' ?></h5>
            </div>
            <div class="card-body">
                <form method="POST" action="<?= BASE_URL ?>?action=<?= $action ?>">
                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input required name="nombre" type="text" class="form-control"
                            value="<?= $esEdicion ? htmlspecialchars($obra->nombre) : '' ?>"
                            placeholder="Nombre de la obra de arte">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea required name="descripcion" class="form-control" rows="5"
                            placeholder="Descripción breve de la obra de arte"><?= $esEdicion ? htmlspecialchars($obra->descripcion) : '' ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Artista <span class="text-danger">*</span></label>
                            <select required name="id_artista" class="form-select">
                                <?php foreach ($artistas as $artista) { ?>
                                    <option value="<?= $artista->id_artista ?>"
                                        <?= ($esEdicion && $obra->id_artista == $artista->id_artista) ? 'selected' : '' ?>>
                                        <?= $artista->nombre_completo ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Año de creación</label>
                            <input name="año_creacion" type="number" class="form-control"
                                value="<?= $esEdicion ? htmlspecialchars($obra->año_creacion) : '' ?>"
                                placeholder="Ingrese el año de creación">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Técnica</label>
                            <input name="tecnica" type="text" class="form-control"
                                value="<?= $esEdicion ? htmlspecialchars($obra->tecnica) : '' ?>"
                                placeholder="Ingrese la técnica utilizada">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Soporte</label>
                            <input name="soporte" type="text" class="form-control"
                                value="<?= $esEdicion ? htmlspecialchars($obra->soporte) : '' ?>"
                                placeholder="Ingrese el soporte utilizado">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Corriente artística</label>
                            <input name="corriente_artistica" type="text" class="form-control"
                                value="<?= $esEdicion ? htmlspecialchars($obra->corriente_artistica) : '' ?>"
                                placeholder="Ingrese la corriente artística">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Imagen</label>
                            <input name="imagen" type="text" class="form-control"
                                value="<?= $esEdicion ? htmlspecialchars($obra->imagen) : '' ?>"
                                placeholder="Ingrese la URL de la imagen">
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary"><?= $esEdicion ? 'Guardar cambios' : 'Guardar obra' ?></button>
                        <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }
}
