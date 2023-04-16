<h1 class="nombre-pagina">Olvide contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña colocando tu correo a continuación</p>
<?php
        include_once __DIR__ . '/../templates/alertas.php';
    ?>
<form class="formulario" action="/olvide" method="POST">

    <div class="campo">
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="input">
            <h5>Correo:</h5>
            <input 
            type="text" 
            name="email_usuario" 
            id="email">
        </div>
    </div>

    <input type="submit" class="boton" value="Enviar instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya eres miembro? Inicia sesión</a>
    <a href="/crear">¿Todavía no eres miembro? Registrarse</a>
</div>