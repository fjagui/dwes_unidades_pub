<!--
  Vista error. Página de error.
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
    <?php include ("include/nav_view.php")?>
    <div class="container">
        <h2>Error:</h2>
        <?php echo $data['mensaje'];?>
    </div>
</body>
</html>
