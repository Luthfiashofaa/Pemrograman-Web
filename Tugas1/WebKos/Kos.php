<?php

namespace WebKos;

abstract class Kos{
    protected $namaKos;
    protected $hargaPerBulan;

    public function __construct($namaKos, $hargaPerBulan){
        $this->namaKos = $namaKos;
        $this->hargaPerBulan = $hargaPerBulan;
    }

    public function getNamaKos(){
        return $this-> namaKos;
    }

    public function getHargaPerBulan(){
        return $this->hargaPerBulan;
    }

    abstract public function fasilitas();
    
}