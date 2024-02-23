<?php

    /* Ejemplo de validación de archivos subidos desde un formularip */

    # Iniciar sesión
    session_start();

    # Saneamiento del formulario.
    $nombre = filter_var($_POST['nombre'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
    $observaciones = filter_var($_POST['observaciones'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
    
    # Cargar el fichero
    $fichero = $_FILES['fichero'];
    
    # Genero array de error de fichero
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );


    # Validación
    $errores = [];
    // Si el error es distinto a 0, algo ha ido mal.
   if(($fichero['error']) !== UPLOAD_ERR_OK){

    # Comprobar qué error se ha producido
    if(is_null($fichero)){
        $errores['fichero'] = $phpFileUploadErrors[1];
    }else{
        // [$fichero['error'] devuelve un índice, que relaciona con el array $phpFileUploadErrors.
        $errores['fichero'] = $phpFileUploadErrors[$fichero['error']];
    }
    
    // Si todo ha ido bien, compruebo si se ha subido el archivo. Lo busco por el nombre temporal que indica que se ha subido.
   }else if(is_uploaded_file($fichero['tmp_name'])){

    # Validar tamaño máximo.
    $max_tamano = 2*1024*1024;
    if($fichero['size'] > $max_tamano){
        $errores['fichero'] = "Tamaño de archivo no permitido. Máximo 2MB.";
    }

    # Validar tipo de archivo.
    // La clase splFileInfo analiza el archivo y comprueba qué tipo de archivo es. 
    $info = new SplFileInfo($fichero['name']);
    $tipos_permitidos = ['JPG','GIF','PNG'];
    // strtoupper convierte la cadena a mayúscula. getExtension, me dice la extenisón del archivo que he subido. Comprueba que esa extensión está en el array.
    if(!in_array(strtoupper($info->getExtension()), $tipos_permitidos)){
     $errores['fichero'] = "Tipo de archivo no permitido. Sólo JPG, GIF o PNG.";
   }
}

   if(!empty($errores)){

    # Creamos la variable de sesión.
    $_SESSION['error'] = 'Formulario no validado';
    $_SESSION['errores'] = $errores;

    $_SESSION['nombre'] = $nombre;
    $_SESSION['observaciones'] = $observaciones;
    $_SESSION['fichero'] = $fichero;

    // # Formulario no validado.
    // header('location: index.php');

   }else{
    # Mover fichero desde carpeta temporal a carpeta del servidor. A la ruta le concateno el nombre del archivo.
    move_uploaded_file($fichero['tmp_name'], 'files/' . $fichero['name']);

    # Genero mensaje.
    $_SESSION['mensaje'] = 'Archivo subido con éxito';

    // # Regreso al formulario.
    // header('location: index.php');
   }
  
    header('location: index.php');
   

?>