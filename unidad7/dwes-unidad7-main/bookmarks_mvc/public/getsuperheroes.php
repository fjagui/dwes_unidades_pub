
<?php
require_once('..\app\Config\parametros.php');
require_once('..\vendor\autoload.php');

use App\Controllers\AjaxController;
use App\Models\Superheroe;
/*
$q = $_GET['q'];
$sh = Superheroe::getInstancia();
$data = $sh->getSuperheroesByFilter($q);
include ('../views/include/list_superheroes_view.php');*/

$q = $_GET['q'];
$sh = new AjaxController();
$sh->ListAction($q);

?>
