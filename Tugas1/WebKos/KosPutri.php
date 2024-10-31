<?php

namespace WebKos;

class KosPutri extends Kos {
    private $fasilitas;

    public function __construct($namaKos, $hargaPerBulan, $fasilitas) {
        parent::__construct($namaKos, $hargaPerBulan);
        $this->fasilitas = $fasilitas;
    }

    public function fasilitas() {
        return $this->fasilitas;
    }
}
