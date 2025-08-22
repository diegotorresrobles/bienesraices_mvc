<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $blog->titulo; ?></h1>
    <img loading="lazy" src="imagenes/<?php echo $blog->imagen; ?>" alt="destacada">
    <p class="informacion-meta">Escrito el: <span><?php echo $blog->creado; ?></span> por: <span><?php echo $blog->autor; ?></span></p>
    <div class="resumen-propiedad">
        <p><?php echo html_entity_decode($blog->contenido); ?></p>
    </div>
</main>