<?php
if(!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
if(!isset($inicio)) {
    $inicio = false;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>

    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/"><img src="/build/img/logo.svg" alt="logotipo"></a>
                <div class="movil-menu">
                    <img src="/build/img/barras.svg" alt="barras">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="dark mode boton" class="dark-mode-boton">
                    <nav class="nav">
                        <a href="/nosotros">Nosotros</a>
                        <a href="/propiedades">Propiedades</a>
                        <a href="/blog">Blog</a>
                        <a href="/contacto">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/admin">Admin</a>
                            <a href="/logout">Salir</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- .barra -->
            <?php if($inicio) { ?>
                <h1>Venta de casas y departamentos de lujo</h1>
            <?php } ?>
        </div>
    </header>
    <?php echo $contenido; ?>
    <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="nav">
                <a href="/nosotros">Nosotros</a>
                <a href="/propiedades">Propiedades</a>
                <a href="/blog">Blog</a>
                <a href="/contacto">Contacto</a>
            </nav>
        </div>
        <p class="copyrigth">Todos los derechos reservados <?php echo date('Y'); ?>  &copy;</p>
    </footer>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>