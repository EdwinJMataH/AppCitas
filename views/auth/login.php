<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar sesión</p>
<?php
    include_once __DIR__ . '/../templates/alertas.php';
?>
<form class="formulario" action="/" method="POST">
    <div class="campo">
        <div class="icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="input">
            <h5>Correo:</h5>
            <input type="text" name="email_usuario" id="email">
        </div>
    </div>
    <div class="campo">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <div class="input">
            <h5>Contraseña:</h5>
            <input type="password"  name="password_usuario" id="password">
        </div>
    </div>
    <input type="submit" class="boton" value="Iniciar sesión">
</form>
<div class="acciones">
    <a href="/crear">¿Todavía no eres miembro? Registrarse</a>
    <a href="/olvide">¿Has olvidado tu contraseña?</a>
</div>

