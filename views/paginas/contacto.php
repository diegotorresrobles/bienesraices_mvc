<main class="contenedor seccion">
    <h1>Contacto</h1>
    <?php if($alerta): ?>
        <div class="alerta exito"><?php echo $alerta; ?></div>
    <?php endif; ?>
    <picture>
        <source srcset="build/img/destacada3.webp" type="image/webp">
        <source srcset="build/img/destacada3.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada3.jpg" alt="destacada 3">
    </picture>
    <h2>Llene el formulario de Contacto</h2>
    <form class="formulario" method="POST">
        <fieldset>
            <legend>Información Personal</legend>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="contacto[nombre]" placeholder="Tu Nombre" require>
            <label for="mensaje">Mensaje:</label>
            <textarea id="mensaje" name="contacto[mensaje]" cols="30" rows="10" require></textarea>
        </fieldset>
        <fieldset>
            <legend>Información sobre la propiedad</legend>
            <label for="opciones">Venta o compra:</label>
            <select id="opciones" name="contacto[tipo]" require>
                <option value="" disabled selected>-- Seleccione --</option>
                <option value="compra">Compra</option>
                <option value="venta">Venta</option>
            </select>
            <label for="precio">Precio o Presupuesto:</label>
            <input type="number" name="contacto[precio]" id="precio">
        </fieldset>
        <fieldset>
            <legend>Información de contacto</legend>
            <p>Como desea ser contactado.</p>
            <div class="forma-contacto">
                <label for="contactar-telefono">Teléfono</label>
                <input name="contacto[contacto]" type="radio" value="telefono" id="contactar-telefono">
                <label for="contactar-email">E-mail</label>
                <input name="contacto[contacto]" type="radio" value="email" id="contactar-email">
            </div>
            <div id="contacto"></div>
        </fieldset>
        <input type="submit" value="Enviar" class="boton-verde">
    </form>
</main>