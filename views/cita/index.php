<h1 class="nombre-pagina">Crear cita</h1>
<!-- <p class="descripcion-pagina">Elige los servicios de tu interés</p> -->
<?php
    include_once __DIR__ .'/../templates/barra.php';
?>

<div>
    <ul class="tabs_titulos">
        <li data-tab="1" class="tab_titulo active">Servicios</li>
        <li data-tab="2" class="tab_titulo">Información cita</li>
        <li data-tab="3" class="tab_titulo">Resumen</li>
    </ul>
    <div class="tabs_contents">
        <div id="content-1" class="tab_content active">
            <h2>Servicios</h2>
            <p class="descripcion-pagina">Elige tus servicios a continuación</p>
            <div id="servicios" class="listado-servicios"></div>
        </div>
        <div id="content-2" class="tab_content">
            <h2>Tus Datos y Cita</h2>
            <p class="descripcion-pagina">Coloca tus datos y fecha de tu cita</p>
            <form class="formulario" action="" method="POST">
                <div class="campo focus">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="input">
                        <h5 class="modificado">Usuario:</h5>
                        <input 
                        type="text" 
                        id="usuarioCita"
                        value="<?= $nombre ?>">
                    </div>
                </div>
                <div class="campo focus">
                    <div class="icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="input">
                        <h5 class="modificado">Fecha:</h5>
                        <input 
                        type="date" 
                        id="fechaCita"
                        min="<?= Date('Y-m-d') ?>">
                    </div>
                </div>
                <div class="campo focus">
                    <div class="icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="input">
                        <h5 class="modificado">Hora:</h5>
                        <input 
                        type="time" 
                        id="horaCita">
                    </div>
                </div>
            </form>
        </div>
        <div id="content-3" class="tab_content resumen">
            <h2>Resumen</h2>
            <p class="descripcion-pagina">Verifica que la información sea correcta</p>
            <div class="contenido-resumen"></div>
        </div>
    </div>

    <div class="paginacion">
        <button 
            id="anterior"
            class="boton"
        >&laquo; Anterior</button>

        <button 
            id="siguiente"
            class="boton"
        >Siguiente &raquo;</button>
    </div>
    <input type="hidden" id="idUsuario" value="<?= $id ?>">
</div>