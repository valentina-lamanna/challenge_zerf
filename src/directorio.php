<?php
include "archivos.php";
class Directorio {
    public $directorioHijas, $archivosHijos  , $nombreDirectorio, $ruta;

    public function __construct($ruta, $nombreDirectorio ,$directorioHijas = array(), $archivosHijos= array()) {
        $this->nombreDirectorio = $nombreDirectorio;
        $this->ruta = $ruta;
        $this->directorioHijas =$directorioHijas;
        $this->archivosHijos =$archivosHijos;
    }

    public function crearArchivo($archivo, $ruta)
    {
        $arc = new Archivo($ruta .'/'. $archivo, $archivo);
        array_push($this->archivosHijos, $arc);
        return $arc;
    }

    public function ls()
    {
        $ls =array();
        foreach ($this->archivosHijos as $arc){
            array_push($ls, $arc->getNombreArchivo());
        }
        foreach ($this->directorioHijas as $dir){
            array_push($ls, $dir->getNombreDirectorio());
        }
        return $ls;
    }

    public function crearDirectorio($directorio, $ruta)
    {
        $dir = new Directorio($ruta . '/' .$directorio, $directorio );
        array_push($this->directorioHijas,$dir);
        return $dir;
    }

    public function pdw()
    {
        return $this->ruta;
    }

    public function existeArchivo($archivo){
        foreach($this->archivosHijos as $arc){
            if($arc->getNombreArchivo === $archivo) return true;
        }
        return false;
    }

    public function existeDirectorio($directorio){
        foreach($this->directorioHijas as $dir){
            if($dir->getNombreDirectorio === $directorio) return true;
        }
        return false;
    }

    public function getNombreDirectorio()
    {
        return $this->nombreDirectorio;
    }

    /**
     * @return array
     */
    public function getArchivosHijos()
    {
        return $this->archivosHijos;
    }

    /**
     * @param array $directorioHijas
     */
    public function setDirectorioHijas($directorioHijas)
    {
        $this->directorioHijas = $directorioHijas;
    }

    /**
     * @param mixed $nombreDirectorio
     */
    public function setNombreDirectorio($nombreDirectorio)
    {
        $this->nombreDirectorio = $nombreDirectorio;
    }

    /**
     * @return array
     */
    public function getDirectorioHijas()
    {
        return $this->directorioHijas;
    }

    /**
     * @param array $archivosHijos
     */
    public function setArchivosHijos($archivosHijos)
    {
        $this->archivosHijos = $archivosHijos;
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
}



