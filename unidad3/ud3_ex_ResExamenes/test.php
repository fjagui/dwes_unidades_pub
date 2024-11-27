<?php
function clearData($dato) {
    if (is_array($dato)) {
        // Si es un array, aplica la limpieza recursivamente
       return array_map('clearData', $dato);
    }
    // Limpieza para valores simples
  
    return htmlspecialchars(stripslashes(trim($dato)), ENT_QUOTES, 'UTF-8');
}

$aDatos = array(
    array("uno"=>"<script>alert('hola mundo')</script>",
          "dos"=>"hola mundo"
        ),
    array(1,2,3,4,)
) ;
$aDatos=clearData($aDatos);

foreach ($aDatos as $clave=>$valor) {
    foreach ($valor as $key=>$value) {
        echo $value;
    }
}
