<?php

namespace WebKos;

class KosPutra extends Kos{

    public function __construct($namaKos, $hargaPerBulan){
        parent::__construct($namaKos, $hargaPerBulan);
    }

    public function fasilitas(){
        return "Kipas Angin, Kamar Mandi Luar, TV Bersama";
    }
}