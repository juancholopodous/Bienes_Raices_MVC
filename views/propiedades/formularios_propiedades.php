 <fieldset> <!-- Agrupamos conjunto de campos relacionados -->
    <legend>Información General</legend>

    <label for="titulo">titulo:</label>
    <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

    <label for="precio">precio:</label>
    <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio Propiedad" value="<?php echo s($propiedad->precio); ?>">

    <label for="imagen">imagen:</label>
    <input type="file" id="imagen" accept="image/jpeg, imag/png" name="propiedad[imagen]"> <!--accept limita el tipo de archivo-->

    <?php if($propiedad->imagen) { ?>
        <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-small" alt="">
    <?php } ?>
    
    <label for="descripcion">descripción:</label>
    <textarea id="descripcion" name="propiedad[descripcion]" ><?php echo s($propiedad->descripcion); ?></textarea>
</fieldset><!-- Cierre de 1° grupo -->

<fieldset>
    <legend>Información Propiedad</legend>

    <label for="habitaciones">habitaciones:</label>
    <input type="number" id="habitaciones" name="propiedad[habitaciones]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->habitaciones); ?>">
    
    <label for="wc">baños:</label>
    <input type="number" id="wc" name="propiedad[wc]" placeholder="Ej: 3" min="1" max="9" value="<?php echo s($propiedad->wc); ?>">
    
    <label for="estacionamiento">estacionamiento:</label>
    <input type="number" id="estacionamiento" name="propiedad[estacionamiento]" placeholder="Ej: 3 ó 0 si no cuentas con uno" min="0" max="9" value="<?php echo s($propiedad->estacionamiento); ?>">
</fieldset><!-- Cierre de 2° grupo -->

<fieldset>
    <legend>Vendedor:</legend>

    <label for="venedor">Vendedor</label>
    <select name="propiedad[vendedores_id]" id="vendedor">
        <option value="">-- Seleccione --</option>
        <?php foreach($vendedores as $vendedor) { ?>
            <option 
                <?php echo $propiedad->vendedores_id === $vendedor->id ? 'selected' : '';?>
                value="<?php echo s($vendedor->id); ?>"><?php echo s($vendedor->nombre) . " " . s   ($vendedor->apellido); ?>
            </option>
        <?php } ?>
    </select>
</fieldset><!-- Cierre de 3° grupo -->