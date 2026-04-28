<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad; // Para establecer la conexión a la BD
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class VendedorController {
    
    public static function crear(Router $router) {
        
        $vendedor = new Vendedor;

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $vendedor = new Vendedor($_POST['vendedor']);

            //GENERAR UN NOMBRE ÚNICO
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
            
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            $errores = $vendedor->validar();

            // Revisar que el array esté vacío
            if(empty($errores)) {
                
                // SUBIDA DE ARCHIVOS
                if(! is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor con el método 'save'
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                
                // Guarda en la base de datos
                $vendedor->guardar();
            }
        }
  
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $vendedor = Vendedor::find($id);

        // Arreglo con mensajes de errores
        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que  envía el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $areglos = $_POST['vendedor'];

            $vendedor->sincronizar($areglos);

            // Validadción
            $errores = $vendedor->validar();

            //GENERAR UN NOMBRE ÚNICO
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
            
            //Subida de archivos
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['vendedor']['tmp_name']['imagen'])->cover(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            if(empty($errores)) {
                if ($_FILES['vendedor']['tmp_name']['imagen']) {

                    // Almacenar la imagen
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar() { // "eliminar" no requiere la utilización de router, ya que usamos ese método para renderizar las vistas.
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
        
            // Validar id
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            if ($id) {
                $tipo = $_POST['tipo'];

                if (validarTipoContenido($tipo)) {
                    $vendedores = Vendedor::find($id);
                    $vendedores->eliminar();
                }
            }
        }
    }
}
