<?php
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $n, bool $inicio = false) {
    include TEMPLATES_URL . "/{$n}.php";
}

function autenticacion() : void {
    session_start();

    if(!$_SESSION['login']) {
        header('Location: /');
    }
}

function precode($v) {
    echo '<pre>';
    var_dump($v);
    echo '</pre>';
    exit;
}

// Escapar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

// Validar tipo de contenido
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad', 'blog'];

    return in_array($tipo, $tipos);
}

// Mostrar mensajes
function mostrarNoty($codigo) {
    $mensaje = '';
    switch($codigo) {
        case 1: 
            $mensaje = 'Creado Correctamente';
            break;
        case 2: 
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3: 
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
        
    }
    return $mensaje;
}

function validarORedireccionar(string $url) {
    // Validar que sea un id valido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if(!$id) {
        header("Location: {$url}");
    }
    return $id;
}