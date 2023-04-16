<h1 class="nombre-pagina">Establecer contraseña</h1>
<p class="descripcion-pagina">Restablece tu contraseña colocando tu nueva contraseñan a continuación</p>
<?php
        include_once __DIR__ . '/../templates/alertas.php';
?>

<?php if($error) return; ?>
<form class="formulario" method="POST">
    <div class="campo">
        <div class="icon">
            <i class="fas fa-lock"></i>
        </div>
        <div class="input">
            <h5>Nueva contraseña:</h5>
            <input type="text" name="password_usuario" id="password">
        </div>
    </div>
    <input type="submit" class="boton" value="Enviar instrucciones">
</form>

<div class="acciones">
    <a href="/">¿Ya eres miembro? Inicia sesión</a>
    <a href="/crear">¿Todavía no eres miembro? Registrarse</a>
</div>