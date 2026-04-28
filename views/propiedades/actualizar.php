<main class="contenedor seccion">
    <h1>Actualizar Propiedad</h1>

    <?php foreach($errores as $error): ?>
        <div class="alerta error">
            <?php echo $error; ?>
        </div>
    <?php endforeach; ?>

    <a href="/admin" class="boton boton-verde">Volver</a>

    <form class="formulario" method="POST" enctype="multipart/form-data"> <!-- Eliminamos el action="/propiedades/actualizar" para que lo mande a la misma URL -->
        <?php include __DIR__ . '/formularios_propiedades.php'; ?>
        <input type="submit" value="Actualizar Propiedad" class="boton-azul-block">
    </form>
</main>