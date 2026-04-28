<?php

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ .'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] .'/imagenes/');
define('URL_BASE', '/public');

function incluirTemplate( string $nombre, bool $inicio = false ) {
    include TEMPLATES_URL . "/" . $nombre.".php";
}

function estaAutenticado() {
    session_start();

    if (!$_SESSION['login']) { // Si no está autenticado redirecciona a la raíz.
        header('Location: /');
    }
}

// Función para debuguear una variable
function debuguear ($variable) {
    echo"<pre>";
    var_dump($variable);
    echo"</pre>";
    exit;
};

// Escapa / Sanitizar el HTML con htmlspecialchars, para prevenir inyecciones de código.
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos); // "in_array" nos permite buscar dentro un tipo de valor.
} // 1° qué se busca (tipo); el 2° es dónde se busca (tipos) 

function validarORedireccionar(string $url) {
    
    // Validar que sea un ID valido
    $id = $_GET['id']; // Tomamos el id
    $id = filter_var($id, FILTER_VALIDATE_INT); // valida que el id sea un entero.

    if (!$id) { //si no es un entero, redireccionamos
        header("Location: {$url}"); 
    }

    return $id;
}