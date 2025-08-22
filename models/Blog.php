<?php
namespace Model;
class Blog extends ActiveRecord {
    // Atributos estaticos
    public static $columnasDB = ['id', 'titulo', 'descripcion', 'contenido', 'imagen', 'creado', 'autor'];
    public static $tabla = 'blog';
    // Atributos de la db
    public $id;
    public $titulo;
    public $descripcion;
    public $contenido;
    public $imagen;
    public $creado;
    public $autor;
    // Constructo
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->contenido = htmlentities($args['contenido']) ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->creado = Date('Y/m/d') ?? '';
        $this->autor = $args['autor'] ?? '';
    }
    public function  validar() {
        if(!$this->titulo) {
            self::$errores[] = 'Debes añadir un titulo';
        };
        if(!$this->imagen) {
            self::$errores[] = 'La imagen es obligatoria';
        };
        if(!$this->descripcion) {
            self::$errores[] = 'Debes añadir un contenido';
        };
        if(strlen($this->descripcion) <= 20) {
            self::$errores[] = 'Debes añadir una descripcion con al menos 20 caracteres';
        };
        if(strlen($this->descripcion) > 200) {
            self::$errores[] = 'La descripcion de tener menos de 200 caracteres';
        };
        if(!$this->contenido) {
            self::$errores[] = 'Debes añadir un contenido';
        };
        if(strlen($this->contenido) <= 50) {
            self::$errores[] = 'Debes añadir un contenido con al menos 50 caracteres';
        };
        if(!$this->autor) {
            self::$errores[] = 'El número de baños es obligatorio';
        };
        return self::$errores;
    }
}