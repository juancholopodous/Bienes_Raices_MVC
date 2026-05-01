<?php

namespace Model;

class Admin extends ActiveRecord {
    
    // Base de datos - Son "protected" porque solo accedemos dentro de esta clase
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password', 'nombre'];

    public $id;
    public $email;
    public $password;
    public $nombre;

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->nombre = $args['nombre'] ?? '';
    }

    public function validar() {
        if (!$this->email) {
            self::$errores[] = 'El email es obligatorio'; // $errores está en ActiveRecord
        }
        if (!$this->password) {
            self::$errores[] = 'El password es incorrecto'; // $errores está en ActiveRecord
        }
        if (!$this->nombre) {
            self::$errores[] = 'El nombre es incorrecto'; // $errores está en ActiveRecord
        }

        return self::$errores;
    }
    
    public function existeUsuario() {
        // Revisamos si el usuario existe ó no
        $query = "SELECT * FROM ". self::$tabla . " WHERE email ='" . $this->email . "' LIMIT 1";

        $resultado = self::$db->query($query);

        // "num_rows" aparece al debuguear $resultado, devuelve 0 ó 1 si existe el valor.
        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }

    public function comprobarPassword($resultado) {
        $usuario = $resultado->fetch_object(); // Así trae el resultado de lo que haya encontrado en la BD

        // La función "password_verify" que nos da PHP para verificar una clave
        $autenticado = password_verify($this->password, $usuario->password);

        if (!$autenticado) {
            self::$errores[] = 'El password es incorrecto';
        }

        return $autenticado;
    }

    public function autenticar() {
        session_start();

        // Llenar el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true; // Este valor lo definimos para ayudarnos a validar el registro.

        header('Location: /admin');
    }

}