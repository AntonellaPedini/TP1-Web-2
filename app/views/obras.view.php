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
                </section>
            </div>
        </main>


    <?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }


    public function renderAgregarObra($artistas){
        require_once __DIR__ . '/templates/layout/header.phtml';
    ?>

        <div class="card h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Nueva obra</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="add">
                    <div class="mb-3">
                        <label class="form-label">Nombre <span class="text-danger">*</span></label>
                        <input required name="title" type="text" class="form-control" placeholder="Nombre de la obra de arte">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea required name="description" class="form-control" rows="5" placeholder="Descripción breve de la obra de arte"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Artista <span class="text-danger">*</span></label>
                            <select required name="id_artista" class="form-select">
                                <?php foreach ($artistas as $artista) { ?>
                                    <option value="<?= $artista->id_artista ?>"><?= $artista->nombre_completo ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Año de creación</label>
                            <input name="year" type="number" class="form-control" placeholder="Ingrese el año de creación de la obra de arte">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Técnica</label>
                            <input name="technique" type="text" class="form-control" placeholder="Ingrese la técnica utilizada en la obra de arte">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Soporte</label>
                            <input name="medium" type="text" class="form-control" placeholder="Ingrese el soporte utilizado en la obra de arte">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Corriente artística</label>
                            <input name="art-movement" type="text" class="form-control" placeholder="Ingrese la corriente artística a la que pertenece la obra de arte">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Imagen</label>
                            <input name="image" type="text" class="form-control" placeholder="Ingrese la URL de la imagen de la obra de arte">
                        </div>

                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Crear incidencia</button>
                        <button type="reset" class="btn btn-outline-secondary">Limpiar</button>
                    </div>
                </form>
            </div>
        </div>
<?php
        require_once __DIR__ . '/templates/layout/footer.phtml';
    }
}
