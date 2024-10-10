<!DOCTYPE html>
<html lang="es">
<head>
    <title>Palabras</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<?php include ("include/nav_view.php")?>

<div class="container">
<h4>Nueva palabra:</h4>
<?php
    echo '<form name="formAddPalabra" method="post" action="'.DIRPUBLIC.'/index.php/palabras/add">';
    echo '<label>Nombre:</label>';
    echo '<input class="form-control form-control-lg" type="text" id="palabra" name="palabra" value="'.$data['palabra'].'" />'.$data['msgErrorPalabra'];
    echo '<div class="col text-center">';
    echo '<input  class="btn btn-primary mb-2 form-control form-control-lg" type="submit" id="save" name="save" value ="Enviar">';			
    echo '</div>';                    
    
    echo '</form>';
?>
</div>
</body>
</html>

