<?php
    /* Eliminar.php
    ejemplo eliminar cookie*/ 

    //Eliminar una cookie
    if(setcookie('datos_personales', "", time()-3600)){
        echo 'Cookie eliminada correctamente.';
    }

    
?>