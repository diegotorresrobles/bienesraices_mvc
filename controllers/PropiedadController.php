<?php
namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {
    public static function index(Router $router) {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $blogs = Blog::all();
        $resultado = $_GET['resultado'] ?? null;
        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'blogs' => $blogs,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router) {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $propiedad = new Propiedad($_POST['propiedad']);
            // Generar nombre
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make(($_FILES['propiedad']['tmp_name']['imagen']))->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            $errores = $propiedad->validar();
            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                $propiedad->guardar();
            }
        }
        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar atributos
            $args = $_POST['propiedad'] ?? null;
            $propiedad->sincronizar($args);
            $imagen = $_FILES['imagen'];
            // Validar
            $errores = $propiedad->validar();
            // Subir archivos
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            if($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make(($_FILES['propiedad']['tmp_name']['imagen']))->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }
            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                // Almacenar magen
                if($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $resultado = $propiedad->guardar();
            }
        } 
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            if($id) {
                $tipo = $_POST['tipo'];
                if(validarTipoContenido($tipo)) {
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }
            }
        }
    }
}