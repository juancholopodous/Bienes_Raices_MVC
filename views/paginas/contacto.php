<main class="contenedor seccion">
        <h1>Contacto</h1>

        <?php if ($mensaje) { ?> <!-- Mensjae de éxito para validación de envío -->
            <p class="alerta exito"><?php echo $mensaje; ?></p>
        <?php } ?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen ">
        </picture>

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario" action="/contacto" method="POST"><!-- TODOS LOS FORMULARIOS VAN DENTRO DE UN FORM -->
            
            <fieldset> <!-- Agrupamos conjunto de campos relacionados -->
                <legend>Información Personal</legend>

                <label for="nombre">Nombre</label>
                <input type="text" placeholder="Tu Nombre" id="nombre" name="contacto[nombre]" required> <!-- "required" obliga a completar el campo -->

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" name="contacto[mensaje]" required></textarea>
            </fieldset><!-- Cierre de 1° grupo -->

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <label for="opciones">Vende ó Compra:</label>
                <select id="opciones" name="contacto[tipo]" required> <!-- el name como "tipo" no importa, ya qye lo que se envía es el VALUE -->
                    <option value="" selected disabled>-- Seleccione --</option>
                    <option value="Compra">Compra</option><!-- El valor del VALUE es lo que se envia al servidor -->
                    <option value="Vende">Vende</option>
                </select>

                <label for="Presupuesto">Precio ó Presupuesto</label>
                <input type="number" placeholder="Tu Precio ó Presupuesto" id="Presupuesto" name="contacto[precio]" min="0" max="99999999.99" step="0.01" required>
            </fieldset><!-- Cierre de 2° grupo -->

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado:</p>
                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input type="radio" value="telefono" id="contactar-telefono" name="contacto[contacto]" required>
                    <!-- el NAME es el mismo en ambos para que solo se tome uno, lo distinto es el VALUE -->
                    <label for="contactar-email">E-mail</label>
                    <input type="radio" value="email" id="contactar-email" name="contacto[contacto]" required>
                </div>

                <div id="contacto"></div><!-- id creado para evento en app.js -->

            </fieldset><!-- Cierre de 3° grupo -->

            <input type="submit" value="Enviar" class="boton-verde">
        </form>

    </main>