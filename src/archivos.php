<?php
class Archivo {
    public $ruta, $nombreArchivo;

    public function __construct($ruta, $nombreArchivo) {
        $this->ruta = $ruta;
        $this->nombreArchivo = $nombreArchivo;
    }

    public function getNombreArchivo()
    {
        return $this->nombreArchivo;
    }

}



