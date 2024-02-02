<?php
class Nodo {
    public $ruta, $nombre, $archivo;

    public function __construct($ruta, $nombre, $archivo= false) {
        $this->ruta = $ruta;
        $this->nombre = $nombre;

    }

    public function getNombre()
    {
        return $this->nombre;
    }

   public function getArchivo(){
   return $this->archivo;
   }

}