<?php

include './directorio.php';
class FileSystem {
    //arrayDeFilesystem es un array de todos los directorios que tiene el filesystem
    public $rutaActual, $directorio, $arbolHome ;

    public function __construct() {
        $this->rutaActual = "/home/valentina";
        $this->directorio = new Directorio('/home/valentina', 'valentina');
        $this->arbolHome = new Directorio('/home/valentina', 'valentina');
    }

    /*
    ---------------------------------------------------------------------------------
        FUNCIONES DEL FILESYSTEM
    ---------------------------------------------------------------------------------

    */

    public function touch($archivo)
    {
        if($this->directorio->existeArchivo($archivo)){
            print 'Ya existe el archivo';
        }
        else{
            $dirDondeSeCreoElArchivo = $this->directorio->crearArchivo($archivo, $this->rutaActual);
             $this->modificarArbolDeDirectorios($dirDondeSeCreoElArchivo);
             print 'Cree el archivo : ' .  $this->rutaActual . '/' . $archivo;
        }
    }
    public function ls()
    {
            print 'ls comun :     ';
         print_r($this->directorio->ls());
    }

     public function ls_r()
        {
            print 'ls recursivo :     ';
            print_r($this->directorio->ls_r());
        }
    public function mkdir($directorio)
    {
        if($this->directorio->existeDirectorio($directorio)){
            print 'Ya existe el directorio';
        }
        else {
            $dirDondeSeCreoElNuevoDir = $this->directorio->crearDirectorio($directorio, $this->rutaActual);
            $this->modificarArbolDeDirectorios($dirDondeSeCreoElNuevoDir);
             print '<br/>Cree el directorio : ' .  $this->rutaActual . '/' . $directorio;
        }
    }


    public function pdw()
    {
        print 'Ruta actual :    '. $this->directorio->pdw();
    }

    public function cd($directorio) {
        if ($directorio === '..') {
            $this->rutaActual = $this->getDirectorioPadre();
        } else {
            if(substr($directorio, 0) ==' /') {$rut=$directorio;}//ruta absoluta
            else{$rut= $this->rutaActual.'/'.$directorio;}//ruta relativa

            if ($this->setarElNuevoDirectoriro($rut)) $this->rutaActual = $rut;
            else  print "Error: Directorio '$directorio' no encontrado.";


        }
    }

        /*
    ---------------------------------------------------------------------------------
        FUNCIONES AUXILIARES
    ---------------------------------------------------------------------------------
    */

    public function modificarArbolDeDirectorios($nodoModificado){
               if( $this->arbolHome->getRuta() === $nodoModificado->getRuta()){
                    $this->setArbolHome($nodoModificado);
               }else{
                    foreach($this->arbolHome->getHijos() as $hijo){
                        $padreModificado = $this->modificarArbolDeDirectoriosRecursivo($this->arbolHome, $hijo, $nodoModificado);
                        $this->setArbolHome($padreModificado);
                    }
               }
         }

    public function modificarArbolDeDirectoriosRecursivo($padre, $nodoACheckear, $nodoModificado) {
                   // Verificar si el nodo a modificar fue encontrado en la rama actual
                   if ($nodoACheckear->getRuta() === $nodoModificado->getRuta()) {
                        $padre->cambiarHijo($nodoACheckear);
                       return $padre;
                   } else {
                       foreach($nodoACheckear->getHijos() as $hijo){
                           return $this->modificarArbolDeDirectoriosRecursivo($nodoACheckear, $hijo, $nodoModificado);

                   }
               }}

    public function getDirectorioPadre() {
       $partes = explode('/', $this->rutaActual);
        array_pop($partes);
        $nuevaRuta =  implode('/', $partes);
        if($this->setarElNuevoDirectoriro($nuevaRuta)){
       return $nuevaRuta;}else{ return 'aaaaaa';}

    }

    public function setarElNuevoDirectoriro($nuevaRuta)
    {

        if ($this->arbolHome->getRuta() === $nuevaRuta) {
            $nuevo = new Directorio($this->arbolHome->getRuta(), $this->arbolHome->getNombre(), $this->arbolHome->getHijos());
        }else{
            $nuevo = $this->chequearHijos($this->arbolHome->getHijos(), $nuevaRuta);
        }

        // Verifica si se encontró el objeto
        if ($nuevo !== null) {
          $this->directorio= $nuevo;
          return true;
        } else {
           return false;
        }
    }

    public function chequearHijos($nodosACheckear, $nuevaRuta){
       foreach($nodosACheckear as $nodoACheckear)
       { if ($nodoACheckear->getRuta() === $nuevaRuta) {
                    return new Directorio($nodoACheckear->getRuta(), $nodoACheckear->getNombre(), $nodoACheckear->getHijos());
          }
          else{
               return $this->chequearHijos($nodoACheckear->getHijos(), $nuevaRuta);
          }}
    }

    public function getArbolHome(){
    return $this->arbolHome;
    }
    public function setArbolHome($home){
        $this->arbolHome =$home;
        print_r($this->arbolHome);
        }
}
