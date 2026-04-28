<?php

namespace Model;

class Propiedad extends ActiveRecord {
    protected static $tabla = 'propiedades';

    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedores_id'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedores_id;

        public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date('Y/m/d');
        $this->vendedores_id = $args['vendedores_id'] ?? '';
    }

    public function validar() {

        if (!$this->titulo) { // $this porque forma parte de la instancia
            self::$errores[] = "El titulo es obligatorio"; //self porque está como estatica
        }
        if (!$this->precio) {
            self::$errores[] = "Debes establecer un precio";
        }
        if ( strlen($this->descripcion) < 50 ) {
            self::$errores[] = "La descripción debe contener al menos 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "Establece el número de habitaciones";
        }
        if (!$this->wc) {
            self::$errores[] = "Indica el número de baños";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "Debes indicar el número de estacionamientos";
        }
        if (!$this->vendedores_id) {
            self::$errores[] = "Elige un vendedor del listado";
        }
        if (!$this->imagen) {
            self::$errores[] = "Debes agregar una imagen";
        }

        return self::$errores;
    }
}