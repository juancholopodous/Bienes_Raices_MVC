<?php
namespace Controllers;

use Model\Propiedad;
use MVC\Router;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {

    public static function index(Router $router) {
        
        $propiedad = Propiedad::get(3);
        $inicio = true; //clase inicio necesaria para menú

        $router->render('paginas/index', [
            'propiedad' => $propiedad,
            'inicio' => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        $router->render('paginas/nosotros'); // No necesitamos pasarle el "[ ]" ya que no pasamos nada en el arreglo.
    }

    public static function blog(Router $router) {       
        $router->render('paginas/blog'); // No necesitamos pasarle el "[ ]" ya que no pasamos nada en el arreglo.
    }

    public static function entrada(Router $router) {        
        $router->render('paginas/entrada'); // No necesitamos pasarle el "[ ]" ya que no pasamos nada en el arreglo.
    }

    public static function propiedades(Router $router) {
        
        $propiedad = Propiedad::all();
        
        $router->render('paginas/propiedades', [
            'propiedad' => $propiedad,
        ]);
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades'); 
        
        // Busacmos esa propiedad por su $id
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function contacto(Router $router) {

        $mensaje = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $respuestas = $_POST['contacto'];
            
            // Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            // Configuramos SMTP -- Protocolo para envío de Emails --
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = 'c4a239edee2f7d';
            $mail->Password = '9c0529260c2625';
            $mail->SMTPSecure = 'tls'; // "tls" es el tipo de encriptación
            $mail->Port = '2525';

            // Configurar el contenido del mail
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Tiene un Nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8'; // Habilita letras asentuadas y demás
            
            // Definir el contenido
            $contenido = '<html>'; // La expresión ".=" es para NO sobreescribir un valor; en su lugar se concatena
            $contenido .= '<p> --- Tienes un nuevo mensaje --- </p>';
            $contenido .= '<p>De - Nombre: '. $respuestas['nombre'] .' </p>';
            $contenido .= '<p>Preferencias de vía de Contacto: '. $respuestas['contacto'] .'</p>';

            // Enviamos según vía de Contacto Seleccionada
            if ($respuestas['contacto'] === 'telefono') {

                $contenido .= '<p>Teléfono: '. $respuestas['telefono'] .'</p>';
                $contenido .= '<p>Fecha para ser contactado: '. $respuestas['fecha'] .'</p>';
                $contenido .= '<p>Preferentemente al rededor de la hora: '. $respuestas['hora'] .'</p>';
            } else {
                // Si la vía es email
                $contenido .= '<p>Email: '. $respuestas['email'] .'</p>';
            }

            $contenido .= '<p>Vende o Compra: '. $respuestas['tipo'] .'</p>';
            $contenido .= '<p>Mensaje: '. $respuestas['mensaje'] .'</p>';
            $contenido .= '<p>Precio o Presupuesto: $'. $respuestas['precio'] .'</p>';
            $contenido .= '</html>';
            
            $mail->Body = $contenido; //Establecemos que el cuerpo del mail tenga el valor definido en $contenido
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar el email
            if ($mail->send()) {
                $mensaje = "El mensaje fue enviado correctamente";
            } else {
                $mensaje = "El mensaje NO fue enviado correctamente"; 
            }

        }
        
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}