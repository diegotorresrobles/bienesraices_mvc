<fieldset>
    <legend>Información General</legend>
    <label for="titulo">Titulo:</label>
    <input type="text" name="blog[titulo]" id="titulo" placeholder="Titulo Blog" value="<?php echo s($blog->titulo); ?>">
    <label for="titulo">Descripción:</label>
    <input type="text" name="blog[descripcion]" id="descripcion" placeholder="Descripcion Blog" value="<?php echo s($blog->descripcion); ?>">
    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, image/png" name="blog[imagen]">
    <?php if($blog->imagen): ?>
        <img src="/imagenes/<?php echo $blog->imagen; ?>" class="imagen-small" alt="imagen.jpg">
    <?php endif; ?>
    <label for="contenido">Contenido:</label>
    <textarea id="contenido" name="blog[contenido]"><?php echo s(html_entity_decode($blog->contenido)); ?></textarea>
</fieldset>
<fieldset>
    <legend>Información</legend>
    <label for="autor">Autor:</label>
    <input type="text" name="blog[autor]" id="autor" placeholder="Alguien" value="<?php echo $blog->autor; ?>">
</fieldset>