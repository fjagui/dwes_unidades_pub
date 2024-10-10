<!DOCTYPE html>
<html lang="es">
<head>
    <title>SuperHéroes</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <?php include ("include/nav_view.php")?>
    <div class="container">
    <h4>Error:</h4>
    <?php
        echo $data['mensaje'];
    ?>
</div>
</body>
</html>
