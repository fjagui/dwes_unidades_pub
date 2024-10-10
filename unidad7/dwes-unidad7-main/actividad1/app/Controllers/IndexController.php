<?php
namespace App\Controllers;

class IndexController extends BaseController {
    public function IndexAction() 
    {
        $data = array('message'=>'Hola mundo');
        $this->renderHTML('../views/index_view.php',$data) ;
    }
    public function SaludaAction($request) {
        $urlDecode = explode('/',$request);

        $data = array('message'=>'Saludos...'.end($urlDecode));
        $this->renderHTML('../views/index_view.php',$data) ;
    }

}
