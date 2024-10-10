<!--
  Vista home. Listado de superhéroes.
-->
<!DOCTYPE html>
<html lang="es">
<head>
    <title>SuperHéroes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>
    <!--Incluye navegación-->
    <?php include ("include/nav_view.php");?>
    <!--Formulario de búsqueda. Utilizamos método get mostrar qué se busca -->
    <form action="<?php echo DIRBASEURL."/superheroes/search";?>" method="get">
      <label for="fname">Localizar SH:</label>
      <input type="text" id="id_q" name="q" value="<?php echo $data['query']; ?>">
      <input type="submit" id="id_search" value="search">
    </form>
    <h1>Listado de SuperHéroes</h1> 
    <?php include ("include/list_superheroes_view.php");?>
</body>
</html>

