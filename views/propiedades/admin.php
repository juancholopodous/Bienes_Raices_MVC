<main class="contenedor seccion" id="admin-page"> <!-- "id="admin-page" se usa para eliminar las alerta con app.js -->
    <h1>Administrador de Bienes Raices</h1>

    <?php if ($resultado) { ?>
        
        <?php if( intval( $resultado ) === 1): ?>
            <p class="alerta exito">Registro Creado Correctamente</p>
        <?php elseif ( intval( $resultado ) === 2 ): ?>
            <p class="alerta exito actualizado">Registro Actualizado Correctamente</p>
        <?php elseif ( intval( $resultado ) === 3 ): ?>
            <p class="alerta exito eliminado">Registro Eliminado Correctamente</p>
        <?php elseif ( intval( $resultado ) === 4 ): ?>
            <p class="alerta exito eliminado">No se puede eliminar: Este vendedor tiene propiedades asignadas</p>
        <?php endif; ?>
        
    <?php } ?>
    
    <h2>Propiedades</h2>
    <a href="/propiedades/crear" class="boton boton-crear">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $propiedades as $propiedad): ?>
            <tr>
                <td><?php echo $propiedad->id; ?></td>
                <td><?php echo $propiedad->titulo; ?></td>
                <td> <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla"></td>
                <td>$<?php echo $propiedad->precio ?></td>
                <td>
                    <form method="POST" class="w-100" action="/propiedades/eliminar"> <!-- Este POST rquiere REQUEST_METHOD -->
                        <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                        <input type="hidden" name="tipo" value="propiedad">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/propiedades/actualizar?id=<?php echo $propiedad->id; ?>" class="boton-azul-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <a href="/vendedores/crear" class="boton boton-crear">Nuevo Vendedor</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Perfil</th>
                <th>Celular</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach( $vendedores as $vendedor): ?>
            <tr>
                <td><?php echo $vendedor->id; ?></td>
                <td><?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                <td> <img src="/imagenes/<?php echo $vendedor->imagen; ?>" class="imagen-tabla"></td>
                <td><?php echo $vendedor->celular ?></td>
                <td>
                    <form method="POST" class="w-100" action="/vendedores/eliminar"> <!-- Este POST rquiere REQUEST_METHOD -->
                        <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                        <input type="hidden" name="tipo" value="vendedor">
                        <input type="submit" class="boton-rojo-block" value="Eliminar">
                    </form>
                    <a href="/vendedores/actualizar?id=<?php echo $vendedor->id; ?>" class="boton-azul-block">Actualizar</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Administrador de Blogs</h2>

    <a href="/blog/crear" class="boton boton-crear">Nueva Entrada</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Imagen</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>  <!--Mostrar los resultados-->
            <?php foreach( $entradas as $entrada): ?>
                <tr>
                    <td><?php echo $entrada->id; ?></td>
                    <td><?php echo $entrada->titulo; ?></td>
                    <td><img src="/imagenes/<?php echo $entrada->imagen; ?>" class="imagen-tabla" alt=""></td>
                    <td><?php echo $entrada->descripcion; ?></td>
                    <td>
                        <form method="POST" class="w-100" action="/blog/eliminar">
                            <input type="hidden" name="id" value="<?php echo $entrada->id; ?>">
                            <input type="hidden" name="tipo" value="propiedad">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">
                        </form>
                        <a href="/blog/actualizar?id=<?php echo $entrada->id; ?>" class="boton-azul-block">Actualizar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>