<?php

namespace Controller;

require_once "Traits/ResponseFormatter.php"; // Menggunakan require_once
require_once "WebKos/Kos.php"; // Menggunakan require_once
require_once "WebKos/KosPutra.php"; // Menggunakan require_once
require_once "WebKos/KosPutri.php"; // Menggunakan require_once

use Traits\ResponseFormatter;
use WebKos\KosPutra;
use WebKos\KosPutri;

class KosController {
    use ResponseFormatter;

    public function getAllKos() {
        $kosPutra1 = new KosPutra("Kos Putra A", 1500000, "AC, Kamar Mandi Dalam, Internet");
        $kosPutra2 = new KosPutra("Kos Putra B", 1200000, "Kamar Mandi Dalam, Wifi");

        $kosPutri1 = new KosPutri("Kos Putri A", 1800000, "AC, Kamar Mandi Dalam, Dapur Bersama");
        $kosPutri2 = new KosPutri("Kos Putri B", 1600000, "Kamar Mandi Dalam, Laundry");

        $kosArray = [
            [
                "namaKos" => $kosPutra1->getNamaKos(),
                "hargaPerBulan" => $kosPutra1->getHargaPerBulan(),
                "fasilitas" => $kosPutra1->fasilitas(),
                "jenis" => "Putra"
            ],
            [
                "namaKos" => $kosPutra2->getNamaKos(),
                "hargaPerBulan" => $kosPutra2->getHargaPerBulan(),
                "fasilitas" => $kosPutra2->fasilitas(),
                "jenis" => "Putra"
            ],
            [
                "namaKos" => $kosPutri1->getNamaKos(),
                "hargaPerBulan" => $kosPutri1->getHargaPerBulan(),
                "fasilitas" => $kosPutri1->fasilitas(),
                "jenis" => "Putri"
            ],
            [
                "namaKos" => $kosPutri2->getNamaKos(),
                "hargaPerBulan" => $kosPutri2->getHargaPerBulan(),
                "fasilitas" => $kosPutri2->fasilitas(),
                "jenis" => "Putri"
            ]
        ];

        return $this->responseFormatter(200, "Success", $kosArray);
    }
}
?>
