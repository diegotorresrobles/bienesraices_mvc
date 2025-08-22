<?php
namespace Controllers;

use Model\Blog;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class PaginaController {
    public static function index(Router $router) {
        $inicio = true;
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $router->render('/paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades,
            'blogs' => $blogs
        ]);
    }
    public static function nosotros(Router $router) {
        $router->render('/paginas/nosotros');
    }
    public static function propiedades(Router $router) {
        $propiedades = Propiedad::all();
        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router) {
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);
        if(!$propiedad) {
            header('Location: /propiedades?error=1');
        }
        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router) {
        $blogs = Blog::all();
        $router->render('/paginas/blog', [
            'blogs' => $blogs
        ]);
    }
    public static function entrada(Router $router) {
        $id = validarORedireccionar('/blog');
        $blog = Blog::find($id);
        if(!$blog) {
            header('Location: /blog?error=1');
        }
        $router->render('/paginas/entrada', [
            'blog' => $blog
        ]);
    }
    public static function contacto(Router $router) {
        $alerta = null;
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mensaje = $_POST['contacto'];
            // Instanciar PHPMailer
            $mail = new PHPMailer();
            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '0be88f8ec77a99';
            $mail->Password = '354b43165c6ebf';
            // Configurar contenido de email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
            $mail->Subject = 'Nuevo Mensaje';
            // Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            // Definir contenido
            $contenido = '<html>';
            $contenido .= '<p>Nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $mensaje['nombre'] . '</p>';
            $contenido .= '<p>Medio a contactar: ' . $mensaje['contacto'] . '</p>';
            if($mensaje['contacto'] === 'email') {
                $contenido .= '<p>Correo: ' . $mensaje['email'] . '</p>';
            } else {
                $contenido .= '<p>Telefono: ' . $mensaje['telefono'] . '</p>';
                $contenido .= '<p>Fecha: ' . $mensaje['fecha'] . '</p>';
                $contenido .= '<p>Hora: ' . $mensaje['hora'] . '</p>';
            }
            $contenido .= '<p>Mensaje: ' . $mensaje['mensaje'] . '</p>';
            $contenido .= '<p>Tipo de mensaje: ' . $mensaje['tipo'] . '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $mensaje['precio'] . '</p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'Texto alternativo sin html';
            // Enviar email
            $resultado = $mail->send();
            echo $mail->ErrorInfo;
            if($resultado) {
                $alerta = 'Mensaje enviado';
            } else {
                $alerta = 'Mensaje no enviado';
            }
        }
        $router->render('paginas/contacto', [
            'alerta' => $alerta
        ]);
    }
    public static function error404(Router $router) {
        $router->render('paginas/404');
    }
}