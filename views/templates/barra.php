<div class="barra">
    <p>Hola! <?= $nombre ?></p>
    <a href="/logout">Cerrar sesión</a>
</div>

<?php if (isset($_SESSION['admin'])) : ?>
    <div class="opciones-admin">
        <a class="opcion-barra" href="/admin">Ver Citas</a>
        <a class="opcion-barra" href="/admin/servicios">Ver Servicios</a>
        <a class="opcion-barra" href="/admin/servicios/crear">Nuevo Servicio</a>
    </div>
<?php endif; ?>