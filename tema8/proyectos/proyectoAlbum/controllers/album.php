<?php

class Album extends Controller
{

    function __construct()
    {

        parent::__construct();


    }

    function render()
    {

        // Inicio o continuo sesión
        session_start();

        // Compruebo usuario autentificado
        // Si no lo está, se envía al login para su registro
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario sin autentificar";
            header("location:" . URL . "login");
        // Si lo está pero no tiene privilegios, se le informa y se envía al index.   
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['main']))) {
            $_SESSION['mensaje'] = "Ha intentado realizar operación sin privilegios";
            header('location:' . URL . 'index');
        } else {
           // si está registtrado y tiene privilegios, se muestra mensaje de OK. 
            if (isset($_SESSION['mensaje'])) {
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }


            // Creo la propiedad title de la vista
            $this->view->title = "Home - Panel Control Albumes";

            // Creo la propiedad albumes dentro de la vista.
            // Del modelo asignado al controlador, ejecuto el método get();
            $this->view->albumes = $this->model->get();
            // Muestro la lista de albumes.
            $this->view->render('album/main/index');
        }

    }

    function new()
    {
        // Iniciar o continuar  sesión
        session_start();

        // Compruebo usuario autentificado
        // Si no lo está, se envía al login para su registro
        if (!isset($_SESSION['id'])) {
            $_SESSION['notify'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        // Si lo está pero no tiene privilegios, se le informa y se envía al index.   
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

         // Crear un objeto album vacio
            $this->view->album = new classAlbum();

            // Comprobar si vuelvo de  un registro no validado
            if (isset($_SESSION['error'])) {

                // Mensaje de error
                $this->view->error = $_SESSION['error'];

                // Autorrellenar formulario con los detalles del  alumno
                $this->view->album = unserialize($_SESSION['album']);

                // Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                // Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            // Etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Albumes";

            // #  obtener los cursos  para generar dinámicamente lista cursos
            // $this->view->cursos = $this->model->getCursos();

            // Cargo la vista con el formulario nuevo album
            $this->view->render('album/new/index');
        }
    }

    function create($param = [])
    {
        // Iniciamos sesión
        session_start();
         // Compruebo usuario autentificado
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            // 1. Seguridad. Saneamos los  datos del formulario
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $num_fotos = filter_var($_POST['num_fotos'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            $num_visitas = filter_var($_POST['num_visitas'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            $carpeta = filter_var($_POST['carpeta'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
           
            // 2. Creamos album con los datos saneados
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $num_fotos,
                $num_visitas,
                $carpeta,
                $id_curso
            );

            // 3. Validación
            $errores = [];

            // Título: obligatorio y menos de 100 caracteres.
            if (empty($titulo)) {
                $errores['titulo'] = 'El campo título es  obligatorio';
            }else if(strlen($titulo)>100){
                $errores['titulo'] = 'El campo es demasiado largo';
            }

            // Descripción: obligatorio.
            if (empty($descripcion)) {
                $errores['descripcion'] = 'El campo descripcion es  obligatorio';
            }

            // Autor: obligatorio. 
            if (empty($autor)) {
                $errores['autor'] = 'El campo autor es  obligatorio';
            } 

            // Fecha: obligatorio. 
            if (empty($fecha)) {
                $errores['fecha'] = 'El campo fecha es  obligatorio';
            } 

            // Lugar: obligatorio. 
            if (empty($lugar)) {
                $errores['lugar'] = 'El campo lugar es  obligatorio';
            } 

            // Categoría: obligatorio. 
            if (empty($categoria)) {
                $errores['categoria'] = 'El campo categoria es  obligatorio';
            } 

             // Carpeta: obligatorio y sin espacios.
             if (empty($carpeta)) {
                $errores['carpeta'] = 'El campo carpeta es  obligatorio';
            } else if(strpos($carpeta, ' ') !== false){
                $errores['carpeta'] = 'El campo no puede tener espacios.';
            }

            // 4. Comprobar  validación
            if (!empty($errores)) {
                // errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # redireccionamos a new
                header('location:' . URL . 'album/new');


            } else {

                # Añadir registro a la tabla
                $this->model->create($album);

             
                # Mensaje
                $_SESSION['mensaje'] = "Album creado correctamente";

                # Redirigimos al main de alumnos
                header('location:' . URL . 'album');

            }

        }
    }

    function edit($param = [])
    {

        // Iniciamos sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            // Obtengo el id del album que voy a editar
            $id = $param[0];

            // Asigno id a una propiedad de la vista
            $this->view->id = $id;

            // title
            $this->view->title = "Editar - Panel de control Album";

            // Obtener objeto de la clase album
            $this->view->album = $this->model->read($id);

            //  // Obtener los cursos
            // $this->view->cursos = $this->model->getCursos();

            // Comprobar si el formulario viene de una no validación
            if (isset($_SESSION['error'])) {

                // Mensaje de error
                $this->view->error = $_SESSION['error'];

                // Autorrellenar formulario con los detalles del  alumno
                $this->view->album = unserialize($_SESSION['album']);

                // Recupero array errores  específicos
                $this->view->errores = $_SESSION['errores'];

                // Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['album']);
                unset($_SESSION['errores']);
            }

            // cargo la vista
            $this->view->render('album/edit/index');

        }
    }

    public function update($param = [])
    {

        // Iniciar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['edit']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            // 1. Saneamos datos del formulario FILTER_SANITIZE
            $titulo = filter_var($_POST['titulo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $descripcion = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $autor = filter_var($_POST['autor'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fecha = filter_var($_POST['fecha'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $lugar = filter_var($_POST['lugar'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $categoria = filter_var($_POST['categoria'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $etiquetas = filter_var($_POST['etiquetas'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $num_fotos = filter_var($_POST['num_fotos'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            $num_visitas = filter_var($_POST['num_visitas'] ??= '', FILTER_SANITIZE_NUMBER_INT);
            $carpeta = filter_var($_POST['descripcion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
          

            // 2. Creamos el objeto album a partir de  los datos saneados del  formuario
            $album = new classAlbum(
                null,
                $titulo,
                $descripcion,
                $autor,
                $fecha,
                $lugar,
                $categoria,
                $etiquetas,
                $num_fotos,
                $num_visitas,
                $carpeta,
                $id_curso
            );

            // Cargo id del album que voya a actualizar
            $id = $param[0];

            // Obtengo el  objeto alumno original
            $alumno_orig = $this->model->read($id);

            // 3. Validación
            // Sólo si es necesario
            // Sólo en caso de modificación del campo

           // 3. Validación
           $errores = [];

           // Título: obligatorio y menos de 100 caracteres.
           if (empty($titulo)) {
               $errores['titulo'] = 'El campo título es  obligatorio';
           }else if(strlen($titulo)>100){
               $errores['titulo'] = 'El campo es demasiado largo';
           }

           // Descripción: obligatorio.
           if (empty($descripcion)) {
               $errores['descripcion'] = 'El campo descripcion es  obligatorio';
           }

           // Autor: obligatorio. 
           if (empty($autor)) {
               $errores['autor'] = 'El campo autor es  obligatorio';
           } 

           // Fecha: obligatorio. 
           if (empty($fecha)) {
               $errores['fecha'] = 'El campo fecha es  obligatorio';
           } 

           // Lugar: obligatorio. 
           if (empty($lugar)) {
               $errores['lugar'] = 'El campo lugar es  obligatorio';
           } 

           // Categoría: obligatorio. 
           if (empty($categoria)) {
               $errores['categoria'] = 'El campo categoria es  obligatorio';
           } 

            // Carpeta: obligatorio y sin espacios.
            if (empty($carpeta)) {
               $errores['carpeta'] = 'El campo carpeta es  obligatorio';
           } else if(strpos($carpeta, ' ') !== false){
               $errores['carpeta'] = 'El campo no puede tener espacios.';
           }

           // 4. Comprobar  validación
           if (!empty($errores)) {
               // errores de validación
               // variables sesión no admiten objetos
               $_SESSION['album'] = serialize($album);
               $_SESSION['error'] = 'Formulario no ha sido validado';
               $_SESSION['errores'] = $errores;

               # redireccionamos a new
               header('location:' . URL . 'album/new');
           }

            # 4. Comprobar  validación

            if (!empty($errores)) {
                # errores de validación
                // variables sesión no admiten objetos
                $_SESSION['album'] = serialize($album);
                $_SESSION['error'] = 'Formulario no ha sido validado';
                $_SESSION['errores'] = $errores;

                # redireccionamos a new
                header('location:' . URL . 'album/edit/' . $id);


            } else {

                # Actualizo registro
                $this->model->update($album, $id);

                # Mensaje
                $_SESSION['mensaje'] = "Album actualizado correctamente";

                # Redirigimos al main de album
                header('location:' . URL . 'album');

            }

        }
    }


    public function order($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo criterio de ordenación
            $criterio = $param[0];

            # Creo la propiedad title de la vista
            $this->view->title = "Ordenar - Panel Control Album";

            # Creo la propiedad albumes dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->albumes = $this->model->order($criterio);

            # Cargo la vista principal de alumno
            $this->view->render('album/main/index');
        }
    }

    public function filter($param = [])
    {

        # inicio o continúo sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['filter']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            # Creo la propiedad title de la vista
            $this->view->title = "Buscar - Panel Control Album";

            # Filtro a partir de la  expresión
            $this->view->albumes = $this->model->filter($expresion);

            # Cargo la vista principal de alumno
            $this->view->render('album/main/index');
        }
    }

        public function show($param=[]){

             # inicar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        }else{
            
            $id = $param[0];
            $album = $this->model->read($id);
            $this->view->id = $id;
            $this->view->album = $this->model->read($id);
            $this->view->title = "Datos del album";        
            $this->view->render('album/show/index');

            $num_fotos = count(glob('images/'. $album->carpeta . '/*'));
            $this->model->contarFotos($id, $num_fotos);
            $this->model->contarNumVisitas($id);
            $album->num_fotos =  $this->model->contarFotos($id, $num_fotos);
            $album->num_visitas = $this->model->contarNumVisitas($id);
        }
    }
    
    public function delete($param = []){

        # inicar sesión
        session_start();

        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";

            header("location:" . URL . "login");

        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['delete']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        } else {

            # obtenemos id del album
            $id = $param[0];

            # Obtenemos el album
            $album = $this->model->read($id);
             # Obtenemos la carpeta del album
             $carpetaAlbum = $album->carpeta;
            # Eliminamos album y carpeta
            $this->model->delete($id, $carpetaAlbum);

            # generar mensaje
            $_SESSION['mensaje'] = 'Album eliminado correctamente';

            # redirecciono al main de alumnos
            header('location:' . URL . 'album');
        }
    }

    // Mostramos la vista para subir imágenes.
    public function subir($param = []){
        # inicio o continúo sesión
        session_start();
        // Compruebo si el usario de ha autenticado.
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
            
        // Compruebo si el usuario tiene permisos para hace esta acción.
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['subir']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'album');
        }else{
          
           $this->view->id = $param[0];
           $this->view->title = "Subir imágenes";
           $this->view->render('album/upload/index');
        }
    }

    // Envía imagen cargada en el formulario a la carpeta del album correspondiente.
    public function enviarImagen($param = []){
         # inicio o continúo sesión
         session_start();
       

         if (!isset($_SESSION['id'])) {
             $_SESSION['mensaje'] = "Usuario debe autentificarse";
             header("location:" . URL . "login");
         } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['album']['enviarImagen']))) {
             $_SESSION['mensaje'] = "Operación sin privilegios";
             header('location:' . URL . 'album');
 
         }else{
          
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

            $fichero = [];
            // Compruebo que se ha enviado un archivo a través del formulario.
            if(isset($_FILES['fichero'])){
                $fichero = $_FILES['fichero'];
            
            // Recorremos el archivo con las imagenes. Obtenemos la clave y el valor de cada elemento.
                foreach($fichero as $key => $value){
                // Si el parámetro error es distinto a 0, algo ha ido mal.
                    if(($fichero['error']) !== UPLOAD_ERR_OK){
                                # Comprobar qué error se ha producido
                                if(is_null($fichero)){
                                    $errores['fichero'] = $phpFileUploadErrors[$fichero['error'][$key]];
                                }else{
                                    // $errores['fichero'] = $phpFileUploadErrors[$fichero['error']];
                                }  
                    // Si todo ha ido bien, compruebo si se ha subido el archivo. Lo busco por el nombre temporal que indica que se ha subido.   
                    }else if(is_uploaded_file($fichero['tmp_name'])){
                        # Validar tamaño máximo.
                        $max_tamano = 5*1024*1024;
                        if($fichero['size'] > $max_tamano){
                            $errores['fichero'] = "Tamaño de archivo no permitido. Máximo 5MB.";
                        }
                        # Validar el tipo de archivo
                        // La clase splFileInfo analiza el archivo y comprueba qué tipo de archivo es.
                        $info = new SplFileInfo($value);
                        $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
                        // strtoupper convierte la cadena a mayúscula. getExtension, me dice la extensión del archivo que he subido. Comprueba que esa extensión está en el array.
                        if(!in_array(strtoupper($info->getExtension()), $tiposPermitidos)){
                            $errores['fichero'] = "Tipo de archivo no permitido.";
                        }
                        
                    }    
  
                if(!empty($errores)){
                    # Creamos la variable de sesión.
                    $_SESSION['error'] = 'Error al subir el archivo.';
                    $_SESSION['errores'] = $errores;
                    $_SESSION['fichero'] = $fichero;
                    // # Formulario no validado. Vuelve al index.
                            header('location: album/main/index');
                    }else{

                        $id = $param[0];
                        // En la variable album añado los datos del album a través del método get del modelo.
                        $album = $this->model->read($id);
                    
                        foreach ($fichero['name'] as $index => $nombreArchivo) {
                            move_uploaded_file($fichero['tmp_name'][$index], 'images/'. $album->carpeta . '/' . $nombreArchivo);
                        }

                        # Genero mensaje.
                        $_SESSION['mensaje'] = 'Archivo subido con éxito';
                    }
                    }
                        header('location:' . URL . 'album');
        
                       

            }  
        
         }
        }
    }
    

?>

