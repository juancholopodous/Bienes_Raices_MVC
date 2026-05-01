<?php

namespace Controllers;

use MVC\Router;
use Model\Admin;
use Model\Entrada;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class EntradaController {

    public static function crear(Router $router) {
        
        $entrada = new Entrada();
        $usuarioId = Admin::all();

        //Arreglo con mensaje de errores 
        $errores = Entrada::getErrores();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            /* Crea una nueva instancia */
            $entrada = new Entrada($_POST['entrada']);
    
            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
    
            /*Setear la imagen*/
            //Realiza un resize a la imagen con intervention
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['entrada']['tmp_name']['imagen'])->cover(800,600);
                $entrada->setImagen($nombreImagen);
            }
    
            $errores = $entrada->validar();

            //Revisar que el arreglo de errores esté vacío
            if (empty($errores)) {
                //Crear una carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                //Guarda la imagen en el servidor
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
    
                //Guarda en la base de datos
                $entrada->guardar();
            }   
        }

        $router->render('blog/crear', [
            'entrada' => $entrada,
            'usuarioId' => $usuarioId,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $entrada = Entrada::find($id);

        // Arreglo con mensajes de errores
        $errores = Entrada::getErrores();

        $usuarioId = Admin::all();

        //Metodo post para actualizar
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Asignar los atributos
            $args = $_POST['entrada'];

            $entrada->sincronizar($args);
    
            // Validadción
            $errores = $entrada->validar();

            //Generar un nombre único
            $nombreImagen = md5( uniqid( rand(), true) ) . ".jpg";
            
            //Revisar que el arreglo de errores esté vacío
            if ($_FILES['entrada']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['entrada']['tmp_name']['imagen'])->cover(800,600);

                $entrada->setImagen($nombreImagen);
            }   


            if (empty($errores)) {
                if ($_FILES['entrada']['tmp_name']['imagen']) {

                    //Guarda la imagen en el servidor
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }
    
                $entrada->guardar();
            }
        }

        $router->render('blog/actualizar', [
            'entrada' => $entrada,
            'usuarioId' => $usuarioId,
            'errores' => $errores
        ]);
        
    }

    public static function eliminar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
    
            //Validar ID
            if ($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)){
                    $entrada = Entrada::find($id);
                    $entrada->eliminar();
                }
            }
        }
    }
    
}