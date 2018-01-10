<?php
    // Abrir el archivo en modo de sólo lectura:
    $archivo = fopen("datos.txt","rb");
    // Recorremos el archivo mostando el contenido de cada línea:
     while( feof($archivo) == false )
     {
       echo fgets($archivo). "<br />";
     }
    fclose($archivo);
?>