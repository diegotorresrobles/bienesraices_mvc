<?php
namespace Model;

class Vendedor extends ActiveRecord {
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];
    protected static $tabla = 'vendedores';

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    } 
    public function  validar() {
        if(!$this->nombre) {
            self::$errores[] = 'Debes añadir el nombre';
        };
        if(!$this->apellido) {
            self::$errores[] = 'Debes añadir los apellido';
        };
        if(!$this->telefono) {
            self::$errores[] = 'Debes añadir el telefono';
        };
        if($this->telefono && !preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'Formato de telefono no valido';
        }

        return self::$errores;
    }
}