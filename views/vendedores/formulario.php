<fieldset>
    <legend>Información General</legend>
    <label for="nombre">Nombre:</label>
    <input type="text" name="vendedor[nombre]" id="nombre" placeholder="Nombre del vendedor" value="<?php echo s($vendedor->nombre); ?>">
    <label for="apellido">Apellido:</label>
    <input type="text" name="vendedor[apellido]" id="Apellido" placeholder="Apellido del vendedor" value="<?php echo s($vendedor->apellido); ?>">
</fieldset>
<fieldset>
    <legend>Información de Contacto</legend>
    <label for="telefono">Telefono:</label>
    <input type="tel" name="vendedor[telefono]" id="telefono" placeholder="Telefono del vendedor" value="<?php echo s($vendedor->telefono); ?>">
</fieldset>