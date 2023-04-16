<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Llenar el formulario</p>
<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>
<form class="formulario" action="/crear" method="POST">
    <div class="campo">
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="input">
            <h5>Nombre:</h5>
            <input 
            type="text" 
            name="nombre_usuario" 
            id="nombre" 
            value="<?= s($usuario->nombre_usuario); ?>">
        </div>
    </div>
    <div class="campo">
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="input">
            <h5>Apellido(s):</h5>
            <input 
            type="text" 
            name="apellido_usuario" 
            id="apellido" 
            value="<?= s($usuario->apellido_usuario); ?>">
        </div>
    </div>
    <div class="campo">
        <div class="icon">
            <i class="fas fa-envelope"></i>
        </div>
        <div class="input">
            <h5>Correo:</h5>
            <input 
            type="text" 
            name="email_usuario" 
            id="email" 
            value="<?= s($usuario->email_usuario); ?>">
        </div>
    </div>
    <div class="campo">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <div class="input">
            <h5>Contraseña:</h5>
            <input 
            type="password" 
            name="password_usuario" 
            id="password" 
            value="<?= s($usuario->nombre_usuario); ?>">
        </div>
    </div>

    <input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya eres miembro? Inicia sesión</a>
</div>