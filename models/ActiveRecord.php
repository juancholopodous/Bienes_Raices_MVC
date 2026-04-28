<?php

namespace Model;

class ActiveRecord {

    // Base DE DATOS mediante atributo estatico
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    // Errores
    protected static $errores = [];


    // Definir la conexión a la BD
    public static function setDB($database) {
        self::$db = $database;//self hace referencia a los atributos estaticos de un mismo Objeto. NO lo cambiamos a static.
    }

    public function guardar() {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Creando un nuevo registro
            $this->crear();
        }
    }

    public function crear() {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();
   
        // JOIN crea un nuevo string a partir de un arreglo
        $string = join(', ', array_keys($atributos));
        
        // Insertar en la base de datos
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        /* $query = " INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_id) VALUES ( '$this->titulo', '$this->precio', '$this->imagen', '$this->descripcion', '$this->habitaciones', '$this->wc', '$this->estacionamiento', '$this->creado', '$this->vendedores_id'); ";  */

        $resultado = self::$db->query($query);
        
        //Mensaje de éxito
        if ($resultado) {
            header('Location: /admin?resultado=1'); // Agregamos "Public"
        }
    }

    public function actualizar() {
        
        // Sanitizar los datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        // Insertar en la base de datos
        $query = " UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores); // "join" une los elementos de un arreglo en un string
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";

        /* $query = " UPDATE propiedades SET titulo = '$this->titulo', precio = '$this->precio', imagen = '$this->imagen', descripcion = '$this->descripcion', habitaciones = '$this->habitaciones', wc = '$this->wc', estacionamiento = '$this->estacionamiento', vendedores_id = '$this->vendedores_id' WHERE id = '" . self::$db->escape_string($this->id) . "' LIMIT 1 "; */

        $resultado = self::$db->query($query);

        if($resultado) {
            // Redireccionando al usuario.
            header('Location: /admin?resultado=2'); //Modificamos el mensaje.
        }
    }

    // Eliminar un registro
    public function eliminar() {
        // ELIMINA la propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) ." LIMIT 1";
        
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarImagen();
            header('location: /admin?resultado=3'); // Agregamos "public"
        }
    }

    // Encargado de iterar cada Atributo. Identifica y une los atributos de la BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue; // Salteamos la columna de 'id'
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    // Encargado de Sanitizar cada iteración
    public function sanitizarAtributos() {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach($atributos as $key => $value) {
            $sanitizado[ $key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    // Validación
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
        static::$errores = [];
        return static::$errores;
    }

    // Subida de archivos
    public function setImagen($imagen) {

        // Elmina la imagen previa
        if( !is_null($this->id) ) { // "isset" revisa si una variable está definida y no es null
            $this->borrarImagen();
        }

        // Asigna al atributo de imagen el nombre de la imagen
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    // Eliminar Archivo
    public function borrarImagen() {

        // Comprobamos si el archivo existe con "file_exists"
        $existeArchivo = file_exists( CARPETA_IMAGENES . $this->imagen );
        
        if ($existeArchivo) {
            unlink( CARPETA_IMAGENES . $this->imagen ); // Eliminamos con "unlink"
        }
    }

    // Lista todas las Propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla; //"static" hereda el metodo y busca en la clase que se esté heredando
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Obtener determinado número de registros
    public static function get($cantidad) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT ". $cantidad; //"static" hereda el metodo y busca en la clase que se esté heredando
        
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    // Busca una Propiedad por su ID
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado); // array_shift devuelve el PRIMER elemento de un arreglo
    }

    //Lo pasamos así para resutilizar "consultarSQL"
    public static function consultarSQL($query) {
        
        // Consultar la base de datos
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = []; // Inicia el arreglo vacío
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro); // Es "static" porque creará la clase desde Propiedad.
        }

        // liberar la memoria
        $resultado->free();

        // retornar los resultados
        return $array;
    }

    protected static function crearObjeto($registro) {
        $objeto = new static; // Crea una nueva instancia de la clase Propiedad

        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) { // Verifica si la propiedad existe en el objeto
                $objeto->$key = $value; // Asigna el valor a la propiedad del objeto
            }
        }

        return $objeto; // Devuelve el objeto creado
    }

    // Sincroniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar( $areglos = [] ) {
        foreach ( $areglos as $key => $value) {
            if(property_exists($this, $key ) && !is_null($value) ) {
                $this->$key = $value;
            } 
        } // "property_existe" revisará que una propiedad de un Objeto exista
    }
}