<?php
namespace Model;

class ActiveRecord {
    // Base de datos
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';
    // Errores
    protected static $errores = [];
    
    // Definir la conexion a la DB
    public static function setDB($db) {
        self::$db = $db;
    }
    public function guardar() {
        if(!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear
            $this->crear();
        }
    }
    public function crear() {
        // Sanitizar los datos
        $datos = $this->sanitizarDatos();

        $query = "INSERT INTO " . static::$tabla . " (";
        $query .= join(', ', array_keys($datos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($datos));
        $query .= " ') ";

        $resultado = self::$db->query($query);
        
        if($resultado) {
            // REDIRECCIONAR
            header('Location: /admin?resultado=1');
        }
    }
    public function actualizar() {
        $datos = $this->sanitizarDatos();

        $valores = [];
        foreach($datos as $key => $value) {
            $valores[] = "{$key} = '{$value}'";
        }
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "'";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if($resultado) {
            // REDIRECCIONAR
            header('Location: /admin?resultado=2');
        }
    }
    // Eliminar
    public function eliminar() {
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if($resultado) {
            $this->borrarImagen();
            // REDIRECCIONAR
            header('Location: /admin?resultado=3');
        }
    }
    // Identificar y unir los datos de la db
    public function datos() {
        $datos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue;
            $datos[$columna] = $this->$columna;
        }
        return $datos;
    }
    public function sanitizarDatos() {
        $datos = $this->datos();
        $sanitzado = [];

        foreach ($datos as $key => $value) {
            $sanitzado[$key] = self::$db->escape_string($value);
        }
        return $sanitzado;
    }
    // Subir Archivos
    public function setImagen($i) {
        // Elimina la imagen
        if(!is_null($this->id)) {
            $this->borrarImagen();
        }
        // Asignar el nombre de la imagen
        if($i) {
            $this->imagen = $i;
        }
    }
    // Eliminar Archivo
    public function borrarImagen() {
        // Comprueba si el archivo existe
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }
    // Validacion
    public static function getErrores() {
        return static::$errores;
    }
    
    public function  validar() {
        static::$errores = [];
        return static::$errores;
    }
    // Listar todas las propiedades
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultaSQL($query);

        return $resultado;
    }
    public static function get($c) {
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $c;
        $resultado = self::consultaSQL($query);

        return $resultado;
    }
    // Buscar un registron por su id
    public static function find($id) {
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = {$id}";
        $resultado = self::consultaSQL($query);
        return array_shift($resultado);
    }
    public static function consultaSQL($q) {
        // Consultar DB
        $resultado = self::$db->query($q);

        // Iterar los resultados
        $array = [];
        while($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }
        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        return $array;
    }
    protected static function crearObjeto($r) {
        $objeto = new static;
        foreach ($r as $key => $value) {
            if(property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        
        return $objeto;
    }
    // Sincroniza el objeto en memoria
    public function sincronizar($args = []) {
        foreach($args as $key => $value) {
            if(property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}