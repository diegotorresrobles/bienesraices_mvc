<?php
namespace Model;
class Admin extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }
    public function validar() {
        if(!$this->email) {
            self::$errores[] = 'El correo es obligatorio';
        }
        if(!$this->password) {
            self::$errores[] = 'La contraceña es obligatoria';
        }
        return self::$errores;
    }
    public function verificarUser() {
        // Revisar si el usuario exisste
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $resultado = self::$db->query($query);
        if(!$resultado->num_rows) {
            self::$errores[] = 'El usuario no existe';
            return;
        }
        return $resultado;
    }
    public function verificarPass($r) {
        $user = $r->fetch_object();
        $auth = password_verify($this->password, $user->password);
        if(!$auth) {
            self::$errores[] = 'El password es incorrecto';
        }
        $errores = Admin::getErrores();
        return $auth;
    }
    public function auth() {
        session_start();
        $_SESSION['email'] = $this->email;
        $_SESSION['login'] = true;
        header('Location: /admin');
    }
}