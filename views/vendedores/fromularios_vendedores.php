 <fieldset> <!-- Agrupamos conjunto de campos relacionados -->
    <legend>Información General</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="vendedor[nombre]" placeholder="Coloca tú nombre" value="<?php echo s($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="vendedor[apellido]" placeholder="Coloca tú apellido" value="<?php echo s($vendedor->apellido); ?>">

    <label for="imagen">imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, imag/png" name="vendedor[imagen]"> <!--accept limita el tipo de archivo-->

    <?php if($vendedor->imagen) { ?>
        <img src="/imagenes/<?php echo $vendedor->imagen; ?>" class="imagen-small" alt="">
    <?php } ?>
</fieldset><!-- Cierre de 1° grupo -->

 <fieldset> <!-- Agrupamos conjunto de campos relacionados -->
    <legend>Información de Contacto</legend>

    <label for="celular">Celular:</label>
    <input type="tel" id="celular" name="vendedor[celular]" placeholder="Coloca tú celular" value="<?php echo s($vendedor->celular); ?>">

    
    <label for="email">Correo:</label>
    <input type="email" id="email" name="vendedor[email]" placeholder="Coloca tú correo" value="<?php echo s($vendedor->email); ?>">

</fieldset><!-- Cierre de 2° grupo -->