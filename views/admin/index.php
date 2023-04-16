<h1 class="nombre-pagina">Crear cita</h1>
<!-- <p class="descripcion-pagina">Elige los servicios de tu interés</p> -->
<?php
    include_once __DIR__ .'/../templates/barra.php';
?>
<h2>Buscar Citas</h2>
<div>
    <form class="formulario" action="" method="POST">
        <div class="campo focus">
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <div class="input">
                <h5 class="modificado">Fecha:</h5>
                <input 
                type="date" 
                id="fecha_cita"
                name="fecha_cita"
                value="<?= $fecha ?>">
            </div>
        </div>
    </form>
</div>

<div class="citas-admin">
    <?php 
        if (count($citas) == 0) : ?>
            <p class="not-found"><span>Citas no encontradas</span></p>
        <?php endif;?>
    <ul class="lista-citas">
        <?php 
        $idCita = 0; 
        $total = 0; ?>
        <?php foreach ($citas as $key => $cita) : ?>
            <?php if ($idCita !== $cita->id) :?>
            <li class="item-cita">
                <p><span>ID: </span><?= $cita->id; ?></p>
                <p><span>Cliente: </span><?= $cita->cliente; ?></p>
                <p><span>Email: </span><?= $cita->email_usuario; ?></p>
                <p><span>Hora: </span><?= $cita->hora_cita; ?></p>
            </li>
            
            <h3>Servicios</h3>
            <?php 
                $idCita = $cita->id;
                endif;  //endif
            ?>
            <p><span>Servicio: </span><?= $cita->servicio. ' $ '.$cita->precio;?></p>
            <?php   
                $total += $cita->precio;
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0 ;
                if (ultimo($actual, $proximo)) : ?>
                    <p class="total">Total: <span>$ <?php echo $total; ?></span></p>
                    <form action="/servicios/eliminar-cita" method="POST">
                        <input type="hidden" name="id" value="<?= $cita->id ?>">
                        <input type="submit" class="boton" value="Eliminar">
                    </form>
                    <hr>
                <?php  endif; ?>
            
        <?php endforeach; //endforeach ?> 
    </ul>
</div>

<script src="build/js/buscador.js"></script>