<?php
/**
 * Aplicación que muestra un formulario para resolver un examen de geografía.
 * Los datos de los exámenes se encuentran almacenados en un array que servirá para
 * crear dinámicamente el formulario
 * 
 * @package u3Ex_ResExamenes
 * @author Jose Aguilera <joseaguilera@iesgrancapitan.orgg
 * @category DWES
 * @license MIT
 * @version 1.0.0
 * @since 2024-11-27 
 */


// Incluimos el fichero de configuración con el array.
require_once('config/config.php');
require_once('lib/functions.php');

/* Proceso de ininicialización */

// Bandera para determinar cuando procesamos el formulario.
$procesarFormulario = false;

// Array que almacena el identificador de las preguntas acertadas para el feedback de las preguntas
$preguntasAcertadas=array();

/*
Determinamos el punto de acceso al script. Carga o envío
Cuando se produce la carga de la página se genera el número aleatorio.
Cuando se produce el envío tenemos que recuperar el número de examen que se resolvió
y se pasó como campo oculto.
*/
if (isset($_POST['send'])) {
   $procesarFormulario = true;
   $indExamen = $_POST['indExamen']; 
} 
else {
   $indExamen = array_rand($aExamenes);
}
// Cargamos el examen
$examen=$aExamenes[$indExamen];
// Contamos el número de preguntas para el cálculo de los porcentajes.
$numeroPreguntas=count($examen['preguntas']);

// Utilizamos un array para almacenar los valores iniciales/defecto de los inputs.
$valExamen=array();
/* Cargamos valores iniciales
   Si es un cb utilizamos un array
   Si es un texto o rb utilizamos una cadena
*/
foreach ($examen['preguntas'] as $key=>$item) {
    $valExamen[$key] = $item['tipo'] == 'cb' ? array() : '';
}

if ($procesarFormulario) {
    // Limpiamos los datos de entrada.
    $valExamen=clearData($_POST['pregunta']);
    // Inicializamos la variable que almacenará la nota.
    $nota=0;
    //Bucle para procesar las respuestas a las preguntas del examen.
    foreach($examen['preguntas'] as $key=>$item) {
        switch ($item['tipo']) {
            //tipo text
            case "text":
                //Creamos un array con la cadena almacenada que está separada por ;
                $respuestas = explode(';',$item['respuesta']);
                //Pasamos a mayúsculas todos los elementos del array
                $respuestas = array_map(function($cadena){return strtoupper(trim($cadena));},
                                        $respuestas);
                //Comprobamos la respuesta comparando cadenas en mayúsculas y sin espacios laterales
                if (in_array(strtoupper(trim($valExamen[$key])), $respuestas)) {
                    $nota++;
                    $preguntasAcertadas[]=$key;
                }
                break;
            case "cb":
               //Comprobamos respuesta. 
               if ($item['respuesta'] === ($valExamen[$key] ?? []))  {
                   $nota++;
                   $preguntasAcertadas[]=$key;

               };

               break;  
            case "vf":
                if (($valExamen[$key] ?? '') === $item['respuesta']) {
                    $nota++;
                    $preguntasAcertadas[]=$key;
                }
                break;
   
        }

}
// Cáculo del porcentaje y el resultado cualitativo.
$porcentajeAciertos = round(($nota/$numeroPreguntas) * 100,2);
switch (true) {
    case ($porcentajeAciertos>= 80):
        $resultadoCualitativo = "Excelente"; // Excelente desempeño
        break;

    case ($porcentajeAciertos >= 50):
        $resultadoCualitativo = "Aceptable"; // Buen desempeño
        break;

    default:
        $resultadoCualitativo = "Bajo"; // Necesita mejorar
        break;
    }
}
?>

<!-- VISTA -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css"> <!-- Enlace al archivo externo -->
    <title>Ejercicio 2</title>
   
</head>
<body>
    <h1>Ejercicio 2</h1>
    <h2><?php echo $examen['titulo']?></h2>
    <form action="" method="post">
        <?php 
            echo "<br/>";
            foreach ($examen['preguntas'] as $key=>$item) {
                //Utilizado para feedback
                $resultadoPregunta='';
                if ($procesarFormulario) {
                    $resultadoPregunta=in_array($key,$preguntasAcertadas) ? ALEGRE : TRISTE;
                } 
                echo ($key+1) .".-". $item['pregunta']." ".$resultadoPregunta;
                    echo "<br/>";
                    switch ($item['tipo']) {
                        case "text":
                            //Cargamos feedback para texto
                            $feedBack = (!$procesarFormulario)?'':$item['respuesta'];
                            echo  "<input type=\"text\" name=\"pregunta[$key]\" value=\"$valExamen[$key]\"/> <span class=\"fb\">$feedBack</span>";  
                      
                            break;
                        case "cb":
                            foreach ($item['opciones'] as $value) {
                                //Cargamos valores seleccionados
                                $check =(in_array($value,($valExamen[$key]??[]))) ? 'checked' :''; 
		                        //Cargamos feedBack para cb
                                $feedBack = ($procesarFormulario && in_array($value,($item['respuesta']??[]))) ? CHECK :'';
                                echo "<input type=\"checkbox\" name=\"pregunta[$key][]\" value= \"".$value."\" $check>". $value ." ". $feedBack;
                                echo "<br/>";
                            }
                            break;
                        case "vf":
                            foreach (['Verdadero','Falso'] as $value) {
                                //Cargamos valor seleccioado
                                $check = ($value === ($valExamen[$key]??'')) ?'checked':'';
                                //Cargamos feedBack para vf
                                $feedBack = ($procesarFormulario && $value == $item['respuesta']) ? CHECK : '';
                                echo  "<input type=\"radio\" name=\"pregunta[$key]\" value= \"$value\" $check>".$value ." ". $feedBack;
                                echo "<br/>";
                            }
                            break;

                    }

             echo "<br/>";

            }
        ?>
        <br/>
        <input type="submit" name = "send" value="Send">
        <input type="hidden" name = "indExamen" value="<?php echo $indExamen?>">
    </form>
    <?php
    if ($procesarFormulario) {
       include('view/resultado_view.php');
    }?>
</body>
</html>