<?php

namespace MVC;

class Router {

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn) {
        $this->rutasGET[$url] = $fn;
    }
    
    public function post($url, $fn) {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas() {

        session_start();

        $auth = $_SESSION['login'] ?? null; 

        // Arreglo de Rutas Protegidas
        $rutas_protegidas = [
            '/admin',
            '/propiedades/crear',
            '/propiedades/actualizar',
            '/propiedades/eliminar',
            '/vendedores/crear',
            '/vendedores/actualizar',
            '/vendedores/eliminar',
            '/blog/crear',
            '/blog/actualizar',
            '/blog/eliminar',
        ];
        
        $urlActual = $_SERVER['REQUEST_URI'] ?? '/';
    	$urlActual = strtok($urlActual, '?');

   		if ($urlActual === '') {
        $urlActual = '/';
    	}

        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proteger las Rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {

            // Si no está atuenticao y estamos en /admin lo movemos a /.
            header('Location: /');
        }

        if ($fn) {
            // URL Existe y hay una función asociada.
            call_user_func($fn, $this);
        } else {
            $this->e404();   
        }
    }

    // Muestra una vista
    public function render($view, $datos = []) {

        foreach($datos as $key => $value) {
            $$key = $value; // Aquí estamos estableciendo que la llave será el mensaje y tendrá el string como valor; "$$" indica variable de variable
        }

        // "ob_start" inicia un almacenamiento en memoria
        ob_start();
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpiamos la memoria

        include __DIR__ . '/views/layout.php';
    }

    //Redireccionar una pagina de Error 404
    public function e404() {      
        ob_start(); // Inicia el almacenamiento en memoria
        include __DIR__ . "/views/error404.php";

        $contenido = ob_get_clean(); // Limpia la memoria

        include __DIR__ . "/views/layout.php";  
    }
}
