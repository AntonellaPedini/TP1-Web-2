<?php 
// obtengo la fecha actual
$date = new DateTime();

?>
    <!-- main footer -->
    <footer class="d-flex flex-wrap justify-content-center align-items-center py-3 my-4 border-top">
        <div class="align-items-center">
        <span class="text-muted"><?= $date->format('Y') ?> Galeria de Arte </span>
        </div>
    </footer>

    <!-- js script para bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
