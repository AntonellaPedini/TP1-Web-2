<?php
//require_once __DIR__ . '/mock_data.php';

class ArtistasModel {
    public function getAll() {
        global $mockArtista;
        return $mockArtista;
    }

    public function getByName($name) {
        $ArtistasList = $this->getAll();

        foreach ($ArtistasList as $Artista) {
            if ($Artista->nombre === $name) {
                return $Artista;
            }
        }

        return null;
    }
}
