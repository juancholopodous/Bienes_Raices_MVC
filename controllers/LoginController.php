<?php

namespace Controllers;
use MVC\Router;
use Model\Admin;

class LoginController {
    
    public static function login(Router $router) {
        
        // Arreglo con mensajes de errores
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $auth = new Admin($_POST);
            
            // Validamos los valores
            $errores = $auth->validar();

            if (empty($errores)) {
                // Verifiacmos SI el usuario existe ó No
                $resultado = $auth->existeUsuario();
                
                if (!$resultado) {
                    // Verifiacmos SI el usuario existe ó No (mensaje de error)
                    $errores = Admin::getErrores();

                } else {
                    // Verificamos el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    
                    if ($autenticado) {
                        // Autenticamos al usuario
                        $auth->autenticar();
                    } else {
                        // Mensaje de error para Password
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('auth/login', [
           'errores'=> $errores
        ]);
    }

    public static function logout() {
        session_start();
        
        $_SESSION = []; // Al dejar vacío el arreglo eliminamos los valores del usuario, cerrando la seción.

        header('Location: /');
    }
}