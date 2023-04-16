<div class="campo focus">
    <div class="icon">
        <i class="fas fa-paw"></i>
    </div>
    <div class="input">
        <h5 class="modificado">Servicio:</h5>
        <input 
        type="text" 
        id="nombre_servicio"
        name="nombre_servicio"
        value="<?= $servicio->nombre_servicio ?>">
    </div>
</div>
<div class="campo focus">
    <div class="icon">
        <i class="fas fa-dollar-sign"></i>
    </div>
    <div class="input">
        <h5 class="modificado">Precio:</h5>
        <input 
        type="number" 
        id="precio_servicio"
        name="precio_servicio"
        value="<?= $servicio->precio_servicio ?>">
    </div>
</div>