<?php

function conectarDB() : mysqli {
    $db = new mysqli('localhost', 'root', 'root', 'bienesraices_crud');
    /*                      Ubicación,  user,  clave, Base de Datos      */

    if (!$db) { /* El simbolo ! implica el inverso ó opuesto */
        echo "Error, no se pudo conectar";
        exit; /*Si la conexión falla, cerramos*/
    }

    return $db;
}