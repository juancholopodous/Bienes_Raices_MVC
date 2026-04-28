<main class="contenedor seccion contenido-centrado">
    <h1>Iniciar Sesión</h1>

    <?php foreach($errores as $error) : ?> <!-- Mensaje de error por cada error -->
        <div class="alerta error">
            <?php echo $error ?>
        </div>
    <?php endforeach; ?>

    <form method="POST" class="formulario" action="/login">
        <fieldset> <!-- Agrupamos conjunto de campos relacionados -->
            <legend>Email y Password</legend>

            <label for="email">E-mail</label>
            <input type="email" name="email" placeholder="Tu Email" id="email">

            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Tu Password" id="password" require>
        </fieldset><!-- Cierre de 1° grupo -->

        <input type="submit" value="Iniciar Sesión" class="boton boton-verde">
    </form>
</main>