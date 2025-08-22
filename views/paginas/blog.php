<main class="contenedor seccion contenido-centrado">
    <?php if($_GET['error'] === '1'): ?>
        <div class="alerta error">Blog no encontrado</div>
    <?php endif; ?>
    <h1>Nuestro Blog</h1>
    <?php foreach($blogs as $blog): ?>
        <article class="entrada-blog">
            <div class="imagen">
                <img src="/imagenes/<?php echo $blog->imagen; ?>" alt="entrada blog 1">
            </div>
            <div class="texto-entrada">
                <a href="/entrada?id=<?php echo $blog->id; ?>">
                    <h4><?php echo $blog->titulo; ?></h4>
                    <p>Escrito el: <span> <?php echo $blog->creado; ?></span> por: <span> <?php echo $blog->autor; ?></span></p>
                    <p><?php echo $blog->descripcion; ?></p>
                </a>
            </div>
        </article>
    <?php endforeach; ?>
    <?php if(!$blogs) { ?>
        <div class="alerta error">No hay blogs</div>
    <?php } ?>
</main>