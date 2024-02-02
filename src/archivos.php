<?php
include_once "nodo.php";

class Archivo extends Nodo {
    public $ruta, $nombre , $archivo;

    public function __construct($ruta, $nombre, $archivo= true) {
        $this->ruta = $ruta;
        $this->nombre = $nombre;
        $this->archivo = $archivo;
    }



}



