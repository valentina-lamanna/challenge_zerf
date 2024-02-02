<?php

include './directorio.php';
class FileSystem {
    public $rutaActual, $directorio, $arbolHome  ;

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
                else  echo "Error: Directorio '$directorio' no encontrado.";
            }
        }


        /*
    ---------------------------------------------------------------------------------
        FUNCIONES AUXILIARES DE TOUCH Y MKDIR
    ---------------------------------------------------------------------------------
    */

    public function modificarArbolDeDirectorios($nodoModificado){
        if( $this->arbolHome->getRuta() === $nodoModificado->getRuta()){ //el modificado es el raiz
           $this->setArbolHome($nodoModificado);
        }else{
            foreach($this->arbolHome->getHijos() as $hijo){
                $padreModificado = $this->modificarArbolDeDirectoriosRecursivo($this->arbolHome, $hijo, $nodoModificado);
                $this->setArbolHome($padreModificado);
            }
        }
    }

    public function modificarArbolDeDirectoriosRecursivo($padre, $nodoACheckear, $nodoModificado) {
      if(!$nodoACheckear->esUnArchivo()){ if ($nodoACheckear->getRuta() === $nodoModificado->getRuta()) {
           return $padre->cambiarHijo($nodoACheckear);
       } else {
           foreach($nodoACheckear->getHijos() as $hijo){
               return $this->modificarArbolDeDirectoriosRecursivo($nodoACheckear, $hijo, $nodoModificado);
           }
           return null;
       }}
   }

     /*
       ---------------------------------------------------------------------------------
           FUNCIONES AUXILIARES DE CD
       ---------------------------------------------------------------------------------
       */

      public function getDirectorioPadre() {
            $partes = explode('/', $this->rutaActual);
            array_pop($partes);
            $nuevaRuta = implode('/', $partes);
            $this->setarElNuevoDirectoriro($nuevaRuta);
            return $nuevaRuta;

        }

    public function setarElNuevoDirectoriro($nuevaRuta)
    {

        if ($this->arbolHome->getRuta() === $nuevaRuta) {
            $nuevo = new Directorio($this->arbolHome->getRuta(), $this->arbolHome->getNombre(), $this->arbolHome->getHijos());

        }else{
            foreach($this->arbolHome->getHijos() as $hijo){
               $nuevo = $this->encontrarNuevoActual($this->arbolHome, $hijo, $nuevaRuta);
            }
        }

        if ($nuevo !== null) {
          $this->directorio = $nuevo;
          return true;
        } else {
           return false;
        }
    }

     public function encontrarNuevoActual($padre, $nodoACheckear, $nuevaRuta) {

           if ($nodoACheckear->getRuta() === $nuevaRuta) {
               return $nodoACheckear;
           } else {
               foreach($nodoACheckear->getHijos() as $hijo){
                   return $this->modificarArbolDeDirectoriosRecursivo($nodoACheckear, $hijo, $nodoModificado);
               }
               return null;
           }
       }

  /*
    ---------------------------------------------------------------------------------
        FUNCIONES AUXILIARES
    ---------------------------------------------------------------------------------
    */
    public function getArbolHome(){
        return $this->arbolHome;
    }
    public function setArbolHome($home){
        $this->arbolHome =$home;
    }

}

