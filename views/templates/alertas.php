<?php
    foreach ($alertas as $key => $mensajes): 
        foreach ($mensajes as $error): 
        ?>
        <div class="alertas <?= $key ?>">
        <?= $error ?>
        </div>
        <?php
        endforeach;
    endforeach;
?>