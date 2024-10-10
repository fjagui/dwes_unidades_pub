<!DOCTYPE html>
<html lang="es">
<head>
    <title>SuperHéroes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
function showSuperheroes(str) {
  if (str.length == 0) {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","http://development.local/dwes/unidades/unidad7/superheroes_mvc/public/getsuperheroes.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

</head>
<body>
    <?php include ("include/nav_view.php")?>

    <form action="">
    <label for="fname">Localizar SH:</label>
    <input type="text" id="fname" name="fname" onkeyup="showSuperheroes(this.value)">
    </form>
    <p><h4>Listado de SuperHéroes</h4> 
    <span id="txtHint">
    <?php
       include ("include/list_superheroes_view.php");
    
   /* Código para trabajar sin ajax
               foreach ($data as $keySH=>$valorSH) {
                        echo $valorSH['nombre'] ." ";
                        echo $valorSH['velocidad'];
                        echo '<a href="'.DIRPUBLIC.'/index.php/superheroes/edit/'.$valorSH['id'].'"> Edit</a>';
                        echo '<a href="'.DIRPUBLIC.'/index.php/superheroes/del/'.$valorSH['id'].'"> Del</a>';
                        echo "<br/>";
                        
                    }*/
    
    ?>
</span></p>
</body>
</html>

