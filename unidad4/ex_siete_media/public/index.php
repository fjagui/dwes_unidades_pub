<?php
/**
 * @author dwes
 * @package unidad4
 * @version 1.0
 * @copyright  Libre
 */
require_once('../app/Lib/functions.php');
session_start();
#Variables auxiliares para control de juego
$nivelRiesgo = array(5,6,7); //Variamos aleatoriamente el nivel de riesgo en el jugo de la máquina.
$puntosUsuario = 0;
$puntosMaquina = 0;
$gameOver = false;
$winner = '';
$victorias=0;
#Inicio del juego, declaración de variables de sesion
if (!isset($_SESSION['baraja'])) {
    $_SESSION['baraja'] = range(1,40);  //Creamos el array
    shuffle($_SESSION['baraja']);  //Barajamos
    $_SESSION['cartasMaquina'] = array();
    $_SESSION['cartasUsuario'] = array();
    $_SESSION['riesgo'] = $nivelRiesgo[rand(0,2)];
    $_SESSION['plantadoUsuario'] = false;
    $_SESSION['plantadoMaquina'] = false;
}

#Cookie contador de victorias.
if (!isset($_COOKIE['victorias']) ) {
    setcookie('victorias',0);
}
else {
    $victorias = $_COOKIE['victorias'];
}

#Parámetro por la url
if (isset($_GET['opc'])) {
    #Opción 3. Reiniciar contador.
    if ($_GET['opc']==3) {
        setcookie('victorias',0,time()-60); 
        $victorias=0;
    }
    
   #Opción 2. Plantar 
   if ($_GET['opc']==2) {
        $_SESSION['plantadoUsuario'] = true;
        #Termina el juego la máquina.
        while (!$_SESSION['plantadoMaquina']) {
            $_SESSION['cartasMaquina'][] = array_pop($_SESSION['baraja']);
            $_SESSION['plantadoMaquina'] = (sumarPuntos($_SESSION['cartasMaquina']) > $_SESSION['riesgo'])?true:false;
       }
       
    } 
    #Opción 1. Pedir carta.
    if ($_GET['opc'] == '1' && !$_SESSION['plantadoUsuario']) {
        #Pide carta usuario
        $_SESSION['cartasUsuario'][] = array_pop($_SESSION['baraja']);

        #Pide carta máquina
        if (!$_SESSION['plantadoMaquina']) {
            $_SESSION['cartasMaquina'][] = array_pop($_SESSION['baraja']);
            $_SESSION['plantadoMaquina'] = (sumarPuntos($_SESSION['cartasMaquina']) > $_SESSION['riesgo'])?true:false;
        }
    }
}

#Calculamos puntos de usuario
$puntosUsuario = sumarPuntos($_SESSION['cartasUsuario']);
#Calculamos puntos de máquina
$puntosMaquina = sumarPuntos($_SESSION['cartasMaquina']);

if ($_SESSION['plantadoMaquina'] && ($_SESSION['plantadoUsuario'])) {
    $gameOver = true;
    $winner = 'Empatados';
    if ( ($puntosMaquina <= 7.5 ) && (($puntosMaquina > $puntosUsuario) || ($puntosUsuario > 7.5))) {$winner = 'Máquina';} 
    if ( ($puntosUsuario <= 7.5 ) && (($puntosUsuario > $puntosMaquina) || ($puntosMaquina > 7.5))) {$winner = 'Usuario';setcookie('victorias',++$_COOKIE['victorias']);} 
}

#Vista
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Siete y Media</title>
    <style>
    </style>
</head>
<body>
    <h1>Las 7 y 1/2<h1>
    <h2>Número de victorias:<?php echo $victorias;?></h2>    
    <a href="cierre_sesion.php">Reiniciar | </a>
    <a href="index.php?opc=1">Pedir carta | </a>
    <a href="index.php?opc=2">Plantar | </a>
    <a href="index.php?opc=3">Iniciar contador</a>
    <div class="box">
        <h3>Jugador:<?php echo $puntosUsuario?></h3>
        <div class="player">
       
        <?php
            foreach ($_SESSION['cartasUsuario'] as $clave=>$valor) {
                echo '<img src="img/'.$valor. '.jpg"/>';
            }
        ?>
        </div>
        <h3>Máquina:<?php echo $puntosMaquina?></h3>
        <div class="player">
        <?php
            foreach ($_SESSION['cartasMaquina'] as $clave=>$valor) {
                if (($_SESSION['plantadoMaquina']) and ($_SESSION['plantadoUsuario'])) {
                    echo '<img src="img/'.$valor. '.jpg"/>';
                }
                else {
                    echo '<img src="img/reverso.jpg"/>';
                }
            }
        ?>
        </div>

</div>
<?php if ($gameOver) {echo 'Ganador: '.$winner;}?>
</body>
</html>
