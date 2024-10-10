<!DOCTYPE html>
<html lang="es">
<head>
    <title>SuperHéroes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script>
function showUser(str) {
  if (str == "") {
    document.getElementById("txtHint").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getsuperheroes.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>

</head>
<body>
    <?php include ("include/nav_view.php")?>

    <form action="">
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname" onkeyup="showUser(this.value)">
    </form>
    <p>Suggestions: <span id="txtHint"></span></p>
 

    <h4>Lista de Superhéroes:</h4>
    <?php
               foreach ($data as $keySH=>$valorSH) {
                        echo $valorSH['nombre'] ." ";
                        echo $valorSH['velocidad'];
                        echo '<a href="'.DIRPUBLIC.'/index.php/superheroes/edit/'.$valorSH['id'].'"> Edit</a>';
                        echo '<a href="'.DIRPUBLIC.'/index.php/superheroes/del/'.$valorSH['id'].'"> Del</a>';
                        echo "<br/>";
                        
                    }



    ?>
</div>
</body>
</html>

