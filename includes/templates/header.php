<?php
if(!isset($_SESSION)) {
    session_start();
}

$auth = $_SESSION['login'] ?? false;
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
                <a href="/index.php"><img src="/build/img/logo.svg" alt="logotipo"></a>
                <div class="movil-menu">
                    <img src="/build/img/barras.svg" alt="barras">
                </div>
                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" alt="dark mode boton" class="dark-mode-boton">
                    <nav class="nav">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            <a href="/cerrarSesion.php">Cerrar Sesión</a>
                        <?php endif; ?>
                    </nav>
                </div>
            </div> <!-- .barra -->
            <?php if($inicio) { ?>
                <h1>Venta de casas y departamentos de lujo</h1>
            <?php } ?>
        </div>
    </header>