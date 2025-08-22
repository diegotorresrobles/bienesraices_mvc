<?php
namespace Controllers;
use MVC\Router;
use Intervention\Image\ImageManagerStatic as Image;
use Model\Blog;
class BlogController {
    public static function crear(Router $router) {
        $blog = new Blog;
        $errores = Blog::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $blog = new Blog($_POST['blog']);
            // Generar nombre
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make(($_FILES['blog']['tmp_name']['imagen']))->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }
            $errores = $blog->validar();
            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                if(!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);
                $blog->guardar();
            }
        }
        $router->render('blog/crear', [ 
            'blog' => $blog,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router) {
        $id = validarORedireccionar('/admin');
        $blog = Blog::find($id);
        $errores = Blog::getErrores();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Asignar atributos
            $args = $_POST['blog'] ?? null;
            $blog->sincronizar($args);
            $image = $_FILES['imagen'];
            // Validar
            $errores = $blog->validar();
            // Subir archivos
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
            if($_FILES['blog']['tmp_name']['imagen']) {
                $image = Image::make(($_FILES['blog']['tmp_name']['imagen']))->fit(800, 600);
                $blog->setImagen($nombreImagen);
            }
            // Revisar que el arreglo de errores este vacio
            if(empty($errores)) {
                // Almacenar magen
                if($_FILES['blog']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $resultado = $blog->guardar();
            }
        } 
        $router->render('/blog/actualizar', [
            'blog' => $blog,
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
                    $blog = Blog::find($id);
                    $blog->eliminar();
                }
            }
        }
    }
}