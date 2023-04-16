<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de servicios</p>
<?php
    include_once __DIR__ .'/../templates/barra.php';
?>

<ul class="lista-citas">
    <?php foreach ($servicios as $key => $servicio) : ?>
    <li class="item-cita">
        <p><span>Servicio: </span><?= $servicio->nombre_servicio; ?></p>
        <p><span>Precio: $</span><?= $servicio->precio_servicio; ?></p>
        <div class="acciones">
            <a class="boton" href="/admin/servicios/actualizar?id=<?= $servicio->id; ?>">Actualizar</a>

            <form action="/admin/servicios/eliminar" method="POST">
                <input type="hidden" name="id" value="<?php echo $servicio->id; ?>">

                <input class="boton" type="submit" value="Borrar" class="boton-eliminar">
            </form>
        </div>
        <hr>
    </li>
    <?php endforeach; ?>
</ul>
