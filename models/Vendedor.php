<?php

namespace Model;

class Vendedor extends ActiveRecord {
    
    protected static $tabla = 'vendedores';

    protected static $columnasDB = ['id', 'nombre', 'apellido', 'celular', 'email', 'imagen', 'creado'];

    public $id;
    public $nombre;
    public $apellido;
    public $celular;
    public $email;
    public $imagen;
    public $creado;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->celular = $args['celular'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->creado = date('Y/m/d');
    }

    public function validar() {

        if (!$this->nombre) { // $this porque forma parte de la instancia
            self::$errores[] = "Tú nombre es obligatorio"; //self porque está como estatica
        }
        if (!$this->apellido) {
            self::$errores[] = "Debes proporcionar un apellido";
        }
        if ( !preg_match('/^\+?[0-9]{10,15}$/', $this->celular) ) {
            self::$errores[] = "Debes proporcionar un celular de contacto";
        }
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            self::$errores[] = "Debes proporcionar un correo";
        }
        if (!$this->imagen) {
            self::$errores[] = "Debes agregar una imagen";
        }

        return self::$errores;
    }

}