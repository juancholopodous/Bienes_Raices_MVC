<div class="contenedor-anuncios">
    <?php foreach ( $propiedad as $propiedades ) { ?>
    <div class="anuncio">

            <img loading="lazy" src="/imagenes/<?php echo $propiedades->imagen; ?>" alt="anuncio">

        <div class="contenido-anuncio">
            <h3><?php echo $propiedades->titulo; ?></h3>
            <p><?php echo $propiedades->descripcion; ?></p>
            <p class="precio"><?php echo $propiedades->precio; ?></p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono-p" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p><?php echo $propiedades->habitaciones; ?></p>
                </li>
                <li>
                    <img class="icono-p" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                    <p><?php echo $propiedades->wc; ?></p>
                </li>
                <li>
                    <img class="icono-p" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p><?php echo $propiedades->estacionamiento; ?></p>
                </li>
            </ul>
                <a href="/propiedad?id=<?php echo $propiedades->id; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>

        </div><!-- Cierre .contenido-anuncio -->
    </div><!-- Cierre .anuncio -->  
    <?php }; ?>
</div><!-- Cierre .contenedor-anuncios -->