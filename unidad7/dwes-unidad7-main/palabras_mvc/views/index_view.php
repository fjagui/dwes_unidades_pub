<!DOCTYPE html>
<html lang="es">
<head>
    <title>Palabras</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
   
</head>
<body>
    
    <?php include ("include/nav_view.php")?>

    <!--form class="d-inline-block" action="" method="GET" class="horizontal">
    <label for="fname">Localizar Palabra:</label>
    <input type="text" id="s" name="s">
    <input type="submit" name="" value="Buscar"/>
    </form-->
    
    <div class="form-group row">
        <fom>
         <div class="col-xs-3">
            <form class="input-group">
              <input type="text" id="from" name="s" class="form-control"/>
              <span class="input-group-btn">
                <button type="submit" name="" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
              </span>
</form>
        </div>

        <div class="col-xs-3">
        <a href="<?php echo DIRPUBLIC.'/index.php/palabras/add'?>" class="btn btn-default">Nueva palabra</a>

        </div>
    </div>

     

    <p><h4>Listado de Palabras</h4> 
    <span id="txtHint">
    <?php
       include ("include/list_palabras_view.php");
             
                    
    ?>
</span></p>
</body>
</html>

