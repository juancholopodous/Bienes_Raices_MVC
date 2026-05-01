<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad; // Para establecer la conexión a la BD
use Model\Vendedor;
use Model\Entrada;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController {
    
    //Static nos permite NO crear una nueva instancia
    public static function index(Router $router) {  

        $propiedades = Propiedad::all(); // el "::" es porque el método all es static.
        $vendedores = Vendedor::all();
        $entradas = Entrada::all();

        // Muestra mensaje condicional
        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado,
            'entradas' => $entradas
        ]);
    }
    // "Router $router" evita que perdamos la referencia que arrastramos desde router.php; de este modo puede ser utilizado por todas las rutas del index


    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $propiedad = new Propiedad($_POST['propiedad']);

            //GENERAR UN NOMBRE ÚNICO
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
            
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            // Revisar que el array esté vacío
            if(empty($errores)) {
                
                // SUBIDA DE ARCHIVOS
                if(! is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Guarda la imagen en el servidor con el método 'save'
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                
                // Guarda en la base de datos
                $propiedad->guardar();
            }
        }

        
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');

        $propiedad = Propiedad::find($id);

        // Arreglo con mensajes de errores
        $errores = Propiedad::getErrores();

        $vendedores = Vendedor::all();

        // Ejecutar el código después de que  envía el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Asignar los atributos
            $areglos = $_POST['propiedad'];

            $propiedad->sincronizar($areglos);

            // Validadción
            $errores = $propiedad->validar();

            //GENERAR UN NOMBRE ÚNICO
            $nombreImagen = md5( uniqid( rand(), true) ) . '.jpg';
            
            //Subida de archivos
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if(empty($errores)) {
                if ($_FILES['propiedad']['tmp_name']['imagen']) {

                    // Almacenar la imagen
                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
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
                    $propiedades = Propiedad::find($id);
                    $propiedades->eliminar();
                }
            }
        }
    }
}
