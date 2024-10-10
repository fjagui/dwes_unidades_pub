<?php
namespace App\Controllers;

use App\Models\Palabra;
class PalabraController extends BaseController {
    
    public function addPalabraAction() {
        // Mejor instalar componentes de validación de terceros y saneamiento de terceros
        $lprocesaFormulario = false;
        $data = array();
        $data['palabra']=$data['palabra']="";
        $data['msgErrorPalabra']="";
        if (!empty($_POST)) {
            $data['palabra']=$_POST['palabra'];
            
            //Validación servidor
            $lprocesaFormulario = true;
            if (empty($_POST['palabra'])) {
                $lprocesaFormulario = false;
                $data['palabra']="La palabra no puede estar vacía";
            }

        }
        if ($lprocesaFormulario) {
            //Funciona con palabra::getInstancia(); Singleton
            //También funciona con new Palabra; Funciona pero perdemos singleton
            // Creado test para ver su funcionamiento.
            $objPalabra = Palabra::getInstancia();
            $objPalabra->setPalabra($_POST['palabra']);
            $objPalabra->set();
            header('Location:'.DIRBASEURL.'/');
                       
        }
        else {
            $this->renderHTML('..\views\add_palabra_view.php',$data) ;
        }
            
    }
    
    /*
    * Borra 
    * @param request string. Cadena de texto con la entrada
    */
    public function delPalabraAction($request) {
      
            $elementos=explode('/',$request);
            $id = end($elementos);
            $objPalabra = Palabra::getInstancia();
            $objPalabra->del($id);
            header('Location:'.DIRBASEURL.'/');
            
    }

    /*
    * Edit
    * @param request string. Cadena de texto con la entrada
    */

    public function editPalabraAction($request) {
           $elementos=explode('/',$request);
           $id = end($elementos);
           $data = array();
           $objPalabra = Palabra::getInstancia();
           $datosPalabra= $objPalabra->get($id);
           if ($datosPalabra) {
              $lprocesaFormulario = false;
              $data = array();
              $data['palabra']= $datosPalabra['palabra'];
              $data['msgErrorPalabra']="";
              if (!empty($_POST)) {
                  $data['palabra']=$_POST['palabra'];
                       
             $lprocesaFormulario = true;
             if (empty($_POST['palabra'])) {
                 $lprocesaFormulario = false;
                 $data['msgErrorPalabra']="La palabra no puede estar vacía";
             }
  
         }
         if ($lprocesaFormulario) {
            
           
             $objPalabra->setPalabra($_POST['palabra']);
             $objPalabra->edit();
             header('Location:'.DIRBASEURL.'/');
                        
         }
         else {
             $this->renderHTML('..\views\edit_palabra_view.php',$data) ;
         }
         }


            
        else {
            $this->renderHTML('..\views\error_view.php',array("mensaje"=>"La palabra no existe"));
        }
            
           
           
    }




}