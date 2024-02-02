<?php
include_once "nodo.php";
include "archivos.php";
class Directorio extends Nodo {
    public $hijos , $nombre, $ruta, $archivo;

    public function __construct($ruta, $nombre ,$hijos = array(), $archivo= false) {
        $this->nombre = $nombre;
        $this->ruta = $ruta;
        $this->hijos =$hijos;
        $this->archivo= $archivo;
    }

    public function crearArchivo($archivo, $ruta)
    {
        $arc = new Archivo($ruta .'/'. $archivo, $archivo);
        array_push($this->hijos, $arc);
        return $this;
    }

    public function ls()
    {
        $ls =array();
        foreach ($this->hijos as $arc){
            array_push($ls, $arc->getNombre());
        }
             return $ls;
    }

     public function ls_r()
        {
            $ls =array();
//             print_r($this->hijos);
            foreach ($this->hijos as $nodo){
                if(!$nodo->getArchivo()){
                    array_push($ls, $nodo->getNombre());
                    $hijos = $nodo->getHijos();
                    foreach($hijos as $h){
                     array_push($ls, $h->getNombre());
                    }
                    if($nodo->tieneHijosDirectorios()){
                        foreach($hijos as $hij){
                            $hij->ls_r();
                        }
                    }

                }else{array_push($ls, $nodo->getNombre());}

            }
                 return $ls;
        }

    public function tieneHijosDirectorios(){
    return count(array_filter($this->hijos, function($h){
        return !$h->getArchivo();
    })) >0;

    }
    public function crearDirectorio($directorio, $ruta)
    {
        $dir = new Directorio($ruta . '/' .$directorio, $directorio );
        array_push($this->hijos,$dir);
        return  $this;
    }

    public function pdw()
    {
        return $this->ruta;
    }

    public function existeArchivo($archivo){
        foreach($this->hijos as $arc){
            if( $arc->getArchivo  && $arc->getNombre === $archivo) return true;
        }
        return false;
    }

    public function existeDirectorio($directorio){
        foreach($this->hijos as $dir){
            if(!$arc->getArchivo  && $dir->getnombre === $directorio) return true;
        }
        return false;
    }

    public function cambiarHijo($hijoACambiar){
        $hijosSInElCambio = array_filter($this->hijos, function($dir) use ($hijoACambiar){
         return $dir->getRuta()  !== $nuevoNodo->getRuta();});
        array_push($this->hijos, $hijoACambiar);
    }

     /**
     * @return mixed
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * @param mixed $ruta
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;
    }

    public function getHijos(){
    return $this->hijos;
    }
}



