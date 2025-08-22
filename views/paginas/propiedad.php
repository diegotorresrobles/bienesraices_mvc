<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad->titulo; ?></h1>
    <picture>
        <img loading="lazy" src="imagenes/<?php echo $propiedad->imagen; ?>" alt="destacada">
    </picture>
    <div class="resumen-propiedad">
        <p class="precio">$<?php echo $propiedad->precio; ?></p>
        <ul class="iconos-caracterizticas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono WC">
                <p><?php echo $propiedad->habitaciones; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono WC">
                <p><?php echo $propiedad->wc; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono WC">
                <p><?php echo $propiedad->estacionamiento; ?></p>
            </li>
        </ul>
        <p><?php echo $propiedad->descripcion; ?></p>
    </div>
</main>