<?php

include './directorio.php';
class FileSystem {
    //arrayDeFilesystem es un array de todos los directorios que tiene el filesystem
    public $rutaActual, $directorio, $arrayDeDirectorios = array();

    public function __construct() {
        $this->rutaActual = "/home/valentina";
        $this->directorio = new Directorio('/home/valentina', '~');
    }


    public function touch($archivo)
    {
        if($this->directorio->existeArchivo($archivo)){
            echo 'Ya existe el archivo';
        }
        else{
            $arc = $this->directorio->crearArchivo($archivo, $this->rutaActual);
        }
    }
    public function ls()
    {
        print_r($this->directorio->ls());
    }
    public function mkdir($directorio)
    {
        if($this->directorio->existeDirectorio($directorio)){
            echo 'Ya existe el directorio';
        }
        else {
            $dir = $this->directorio->crearDirectorio($directorio, $this->rutaActual);
            array_push($this->arrayDeDirectorios, $dir);
        }
    }
    public function pdw()
    {
        print $this->directorio->pdw();
    }

    public function cd($directorio) {
        if ($directorio === '..') {
            $this->rutaActual = $this->getDirectorioPadre();
        } else {
            if(substr($directorio, 0) ==' /') {$rut=$directorio;}//ruta absoluta
            else{$rut= $this->rutaActual.'/'.$directorio;}//ruta relativa

            if ($this->setarElNuevoDirectoriro($rut)) $this->rutaActual = $directorio;
            else  echo "Error: Directorio '$directorio' no encontrado.";
        }
    }

    public function getDirectorioPadre() {
        $partes = explode('/', $this->rutaActual);
        array_pop($partes);
        $nuevaRuta = '/' . implode('/', $partes);
        $this->setarElNuevoDirectoriro($nuevaRuta);
        return $nuevaRuta;

    }

    public function setarElNuevoDirectoriro($nuevaRuta)
    {
        foreach ($this->arrayDeDirectorios as $dir) {
            if ($dir->ruta === $nuevaRuta) {
                $nuevo = new Directorio($dir->getRuta(), $dir->getNombreDirectorio(), $dir->getDirectorioHijas, $dir->getArchivosHijos());
                break; // Termina el bucle cuando se encuentra el objeto
            }
        }
        // Verifica si se encontró el objeto
        if ($nuevo !== null) {
           return false;
        } else {
          $this->directorio= $nuevo;
          return true;
        }
    }
}
