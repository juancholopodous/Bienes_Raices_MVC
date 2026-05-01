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

    public static function eliminar() {
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            $tipo = $_POST['tipo'];

            if ($id && validarTipoContenido($tipo)) {
                
                // Busca si tiene propiedades asociadas con Where donde Columna = 'vendedores_id' y Valor = $id
                $propiedades = Propiedad::where('vendedores_id', $id);

                if (!empty($propiedades)) {
                    // Si tiene propiedades, no podemos eliminar
                    header('Location: /admin?resultado=4');

                    exit; // Detenemos la ejecución
                }

                // Si llega aquí, es que no tiene propiedades y procedemos a...
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
                
                // Redirigir al admin con mensaje de éxito
                header('Location: /admin?resultado=3');
            }
        }
    }
}
