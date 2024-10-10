<?php
namespace App\Controllers;
use App\Models\Palabra;

class IndexController extends BaseController {
    public function IndexAction() {
        // Si no buscamos se cargan las útlimas 5 
        $data = array();
        $palabra = Palabra::getInstancia();
        $data = ($_GET) ? $palabra->getPalabrasByFilter($_GET['s']) : $palabra->getUltimasPalabras();
       $this->renderHTML('..\views\index_view.php',$data) ;
    }

}
