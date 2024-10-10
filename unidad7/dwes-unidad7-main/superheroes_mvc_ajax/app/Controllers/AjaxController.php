<?php
namespace App\Controllers;

use App\Models\Superheroe;
class AjaxController extends BaseController {
    public function ListAction($filter) {
        $data = array();
        $sh = Superheroe::getInstancia();
        $data = $sh->getSuperheroesByFilter($filter);
         $this->renderHTML('../views/include/list_superheroes_view.php',$data) ;
    }

}
