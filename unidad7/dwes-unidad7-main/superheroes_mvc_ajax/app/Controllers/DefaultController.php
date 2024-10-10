<?php
namespace App\Controllers;

//use de las clases que vamos a utilizar.
class DefaultController extends BaseController {
    private function diezPares() {
        $anumeros = array();
        for ($i=1;$i<=10;$i++) {
            $anumeros[] = 2*$i;
        }
        return $anumeros;   
    }

    public function saludaAction() {
        $data = array();
        $this->renderHTML('../views/holamundo_view.php',$data) ;
    }

    public function numerosAction() {
        $data = array();
        $data = $this->diezPares();
        $this->renderHTML('../views/numeros_view.php',$data) ;
    }

}
