<?php
    require ('fpdf/fpdf.php');
    require('class/classPDFCliente.php');

    class Cliente extends Controller{
        function __construct(){
            parent::__construct();
        }

       
        function render(){
         
            # Iniciamos o continamo sesión
            session_start();

            # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = 'Usuario debe autentificarse';
                header('location:'. URL . 'login');
            # Pregunta si tiene privilegios para identificarse.
            }else if (!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['main'])){
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'index');
            }else{    
            # Comprobamos si en la sesión existe un mensaje. 
            # Si existe lo mostramos, y a continuación lo borramos.
            if(isset($_SESSION['mensaje'])){
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }

            # Titulo de la página
            $this->view->title = "Tabla Clientes";

            # Creo la propiedad clientes dentro de la vista del modelo.
            # Del modelo asigando al controlador, ejecuto el método get().
            $this->view->clientes = $this->model->get();

            # La vista nos envío al main de cliente
            $this->view->render('cliente/main/index');
        }
    }

        function new(){

            # Abrimos o continuamos sesión.
            session_start();

             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['new'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
            }else{   
           
            # Creamos un objeto Cliente vacío.
            $this->view->cliente = new classCliente();

            # Comprobamos si el formulario contiene algún error, es decir, no ha sido validado.
            if(isset($_SESSION['error'])){

                # Mostramos el mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorellena el formulario de nuevo con los datos almacenados en la "sesión cliente" a través del método "unserialize"
                $this->view->cliente = unserialize($_SESSION['cliente']);

                # Recuperamos el array que contiene los errores específicos.
                $this->view->errores = $_SESSION['errores'];

                # Eliminamos las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['cliente']);


            }
            # Título de la página.
            $this->view->title = "Añadir - Gestión Clientes";

            # Carga vista con el formulario de nuevo cliente.
            $this->view->render('cliente/new/index');
        }
    }
      
        function create($param=[]){

            # Iniciamo o contianuamo sesión.
            session_start();

             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['new'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
            }else{   
            # Por seguridad saneamos los datos del formulario para evitar posibles inyecciones de código a la bbdd no deseado.
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
          
            # Creamos el cliente con los datos saneados.
            # Cargamos los datos del formulario.
            $cliente = new classCliente(
                null,
                $apellidos,
                $nombre,
                $telefono,
                $ciudad,
                $dni,
                $email);

            # Validación de datos.
            # Creamos un array de errores donde se almacenarán los posibles errores que contenga el formulario.
            $errores = [];

            # Indicamos los posibles errores que pueden aparecer en cada campor del formulario.
            # En caso de que se inserte algún dato incorrecto, se cragará en el array 'errore'.

            // Apellidos: obligatorio y tamaño max 45 caractere.
            if(empty($apellidos)){
                $errores['apellidos'] = 'El campor es obligatorio';
            }else if(strlen($apellidos)>45){
                $errores['apellidos'] = 'El campo es demasiado largo';
            }

            // Nombre: obligatorio y tamaño max 20 caracteres.
            if(empty($nombre)){
                $errores['nombre'] = 'El campor es obligatorio';
            }else if(strlen($nombre)>20) {
                $errores['nombre'] = 'El campo es demasiado largo';
            }

             // Teléfono: No obligatorio y tamaño max 9 dígitos.
             if(strlen($telefono)>9){
                 $errores['telefono'] = 'El campo es demasiado largo';
            }

            // Ciudad: obligatorio y tamaño max 20 caracteres.
            if(empty($ciudad)){
                $errores['ciudad'] = 'El campo es obligatorio';
            }else if(strlen($ciudad)>20){
                $errores['ciudad'] = 'El campo es demasiado largo';
            }
            
            // DNI: obligatorio, 8 dígitos y letra mayúscula. Tiene que ser único.
            $options = [ 'options' => ['regexp' => '/^(\d{8})([A-Z])$/']];

            if(empty($dni)){
                $errores['dni'] = 'El DNI no puede quedar vacío.';
            }else if(!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)){
                $errores['dni'] = 'Formato DNI incorrecto.';
            }else if(!$this->model->validateUniqueDni($dni)){
                $errores['dni'] = 'El DNI ya existe.';
            }

            // Email: obligatorio, formato válido. Tiene que ser único.
            if(empty($email)){ 
                $errores['email'] = 'El campo email es obligatorio';
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Formato email no es válido.';
            }else if(!$this->model->validateUniqueEmail($email)){
                $errores['email'] = 'Ese email ya existe';
            }

            # Comprobamos validación.
            # Si el array errores contiene algún dato, quiere decir que no se ha realizado la validación.
            # En ese caso se crean diferentes variables de Session que se moostrarán de nuevo en el formulario.
            if(!empty($errores)){
                
                $_SESSION['cliente'] = serialize($cliente);
                // Mensaje de error a mostrar en el formulario.
                $_SESSION['error'] = 'Formulario no ha sido validado';
                // Errores que aparecen en el formulario.
                $_SESSION['errores'] = $errores;

                # Nos redirige de nuevo al formulario.
                header('location:'. URL . 'cliente/new');
            }else{
                # Si el formulario ha sido validado.
                # Se crea una nuevo cliente en la BBDD a través del método create del modelo.
                $this->model->create($cliente);
                # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
                $_SESSION['mensaje'] = 'Cliente creado correctamente.';
                # Nos redirige al main de cliente.
                header('location:' . URL . 'cliente');
            }
        }
    }

       
        function edit($param =[]){
            
             # Iniciamos o continuamos sesión
             session_start();
              # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
            }else{   
             # Obtenemos el id del cliente que queremos editar
            $id = $param[0];
            # Asignamos id a la propiedad de la vista id para mostrat los datos que correspoden a es id.
            $this->view->id = $id;
            # Título de la página.
            $this->view->title = 'Editar - Gestión Clientes';
            # Obtenemos el cliente solicitado a través del método read del modelo.
            $this->view->cliente = $this->model->read($id);
            
            # Comprobamos que no exista la varaibale de sesión error. 
            # Si existe quiere decir que los datos no han sido validados.
            if(isset($_SESSION['error'])){
                # Muestra mensaje de error.
                $this->view->error = $_SESSION['error'];
                # Autorellena el formulario de nuevo con los datos almacenados en la "sesión cliente" a través del método "unserialize"
                $this->view->cliente = unserialize($_SESSION['cliente']);
                # Recuperamos el array que contiene los errores específicos.
                $this->view->errores = $_SESSION['errores'];
                # Eliminamos las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['cliente']);
            }
            # Mostramos los datos del cliente.
            $this->view->render('cliente/edit/index');
        }
    }
        function update($param = []){

            # Iniciamos o continuamos sesión
            session_start();
             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['edit'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
            }else{   
            # Por seguridad saneamos los datos del formulario para evitar posibles inyecciones de código a la bbdd no deseado.
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $ciudad = filter_var($_POST['ciudad'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            
            $cliente = new classCliente(
                null,
                $apellidos,
                $nombre,
                $telefono,
                $ciudad,
                $dni,
                $email);
                
            # Cargamos el id del cliente que queremos editar.
            $id = $param[0];
            # Obtengo el objeto cliente original.
            $cliente_orig = $this->model->read($id);

            # Validación de datos.
            # Creamos un array de errores donde se almacenarán los posibles errores que contenga el formulario.
            $errores = [];

            # Indicamos los posibles errores que pueden aparecer en cada campor del formulario.
            # En caso de que se inserte algún dato incorrecto, se cragará en el array 'errores'.

            // Apellidos: obligatorio y tamaño max 45 caractere.
            if (strcmp($cliente->apellidos, $cliente_orig->apellidos) !== 0){
            if(empty($apellidos)){
                $errores['apellidos'] = 'El campor es obligatorio';
            }else if(strlen($apellidos)>45 ){
                $errores['apellidos'] = 'El campo es demasiado largo';
            }
            }

            // Nombre: obligatorio y tamaño max 20 caracteres.
            if (strcmp($cliente->nombre, $cliente_orig->nombre) !== 0){
            if(empty($nombre)){
                $errores['nombre'] = 'El campor es obligatorio';
            }else if(strlen($nombre)>20){
                $errores['nombre'] = 'El campo es demasiado largo';
            }
                        }
            //Teléfono: Obligatorio
            if (strcmp($cliente->telefono, $cliente_orig->telefono) !== 0) {
                if (empty($telefono)) {
                    $errores['telefono'] = 'El campo telefono es obligatorio';
                } elseif (!is_numeric($telefono) || strlen($telefono) !== 9) {
                    $errores['telefono'] = 'El teléfono debe ser numérico y tener 9 dígitos';
                }
            }

             //Ciudad: Obligatorio
             if (strcmp($cliente->ciudad, $cliente_orig->ciudad) !== 0) {
                if (empty($ciudad)) {
                    $errores['ciudad'] = 'El campo ciudad es obligatorio';
                } elseif (strlen($ciudad) > 20) {
                    $errores['ciudad'] = 'El campo ciudad no debe superar los 20 caracteres';
                }
            }
            
            // DNI: obligatorio, 8 dígitos y letra mayúscula. Tiene que ser único.
            $options = [ 'options' => ['regexp' => '/^(\d{8})([A-Z])$/']];

            if (strcmp($cliente->dni, $cliente_orig->dni) !== 0){
            if(empty($dni)){
                $errores['dni'] = 'El DNI no puede quedar vacío.';
            }else if(!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)){
                $errores['dni'] = 'Formato DNI incorrecto.';
            }else if(!$this->model->validateUniqueDni($dni)){
                $errores['dni'] = 'El DNI ya existe.';
            }
            }

            // Email: obligatorio, formato válido. Tiene que ser único.
            if (strcmp($cliente->email, $cliente_orig->email) !== 0){
            if(empty($email)){ 
                $errores['email'] = 'El campo email es obligatorio';
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Formato email no es válido.';
            }else if(!$this->model->validateUniqueEmail($email)){
                $errores['email'] = 'Ese email ya existe';
            }
            }

            # Comprobamos validación.
            # Si el array errores contiene algún dato, quiere decir que no se ha realizado la validación.
            # En ese caso se crean diferentes variables de Session que se mostrarán de nuevo en el formulario.
            if(!empty($errores)){
                // Nos muestra los datos del cliente.
                $_SESSION['cliente'] = serialize($cliente);
                // Mensaje de error a mostrar en el formulario.
                $_SESSION['error'] = 'Formulario no ha sido validado';
                // Errores que aparecen en el formulario.
                $_SESSION['errores'] = $errores;

                # Nos redirige de nuevo al formulario.
                header('location:'. URL . 'cliente/edit/' . $id);
            }else{
                # Si el formulario ha sido validado.
                # Se crea un nuevo cliente en la BBDD a través del método create del modelo.
                $this->model->update($cliente, $id);
                # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
                $_SESSION['mensaje'] = 'Cliente editado correctamente.';
                # Nos redirige al main de cliente.
                header('location:' . URL . 'cliente');
           }
        }    
        }


        function delete($param=[]){

             # Inicio o continúo sesión, en este caso del create
             session_start();

             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                 $_SESSION['notify'] = 'Usuario debe autentificarse';
 
                 header('location:'. URL . 'login');
             }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['delete'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
                }else{
                    $id = $param[0];
                    $this->view->id = $id;

                    $this->model->delete($id);

                    header("location:".URL."cliente");
            }
        }

       
        function show($param=[]){
           
            $id = $param[0];

            $this->view->id = $id;

            $this->view->title = "Datos del cliente";

            $this->view->cliente = $this->model->read($id);

            $this->view->render('cliente/show/index');
        }


        function order($param=[]){

             # Inicio o continúo sesión, en este caso del create
             session_start();

            # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                 $_SESSION['mensaje'] = 'Usuario debe autentificarse';
 
                 header('location:'. URL . 'login');

             }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['order'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'cliente');
             }
             else{
            # Obtenemos criterio de ordenación.
            $criterio = $param[0];
            # Título de la página.
            $this->view->title = 'Ordenar - Tabla Clientes';
            # Creamos la propiedad clientes dentro de la vista.
            # Ejecutamos el método order.
            $this->view->clientes = $this->model->order($criterio);
            # Se carga la vista principal del cliente.
           $this->view->render('cliente/main/index');
        }
    }
    
        function filter($param=[]){
             # Inicio o continúo sesión, en este caso del create
             session_start();

             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                 $_SESSION['notify'] = 'Usuario debe autentificarse';
 
                 header('location:'. URL . 'login');

             }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['filter'])){ 
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'filter');
             }
             else{
           
            $expresion = $_GET['expresion'];

            $this->view->title = 'Filtrar - Tabla Clientes';

            $this->view->clientes = $this->model->filter($expresion);

            $this->view->render('cliente/main/index');
        }
    }


        // Método para exportar archivo CSV
    function exportCSV(){
         # Inicio o continúo sesión, en este caso del create
         session_start();

         # Comprobar si el usuario está autentificado
          if(!isset($_SESSION['id'])) {
              $_SESSION['mensaje'] = 'Usuario debe autentificarse';

              header('location:'. URL . 'login');

          }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['exportCSV'])){ 
             $_SESSION['mensaje'] = "Operación sin privilegios";
             header('location:'.URL.'cliente');
          }
          else{
           
            # Recogemos los datos del los clientes
            $clientes = $this->model->get();

            # Creamos el archivo CSV donde exportaremos los datos de los clientes 
            $archivoCSV = 'clientes' . 'csv';
            # Abrimos un puntero para escribir los datos en el archivo
            $clientesCSV = fopen($archivoCSV, 'w'); 
            # Añadimos una cabecera al archivo CSV
            fputcsv($clientesCSV, ['Id','Cliente','Email','Telefono','Ciudad','DNI']);
            # Recorremos todos los datos extraidos de la BBDD y la vamos escribiendo en el archivo CSV.
            foreach($clientes as $cliente){
                fputcsv($clientesCSV, [$cliente->id,$cliente->cliente,$cliente->email,$cliente->telefono,$cliente->ciudad,$cliente->dni]);
            }
            # Cerramos el archivo CSV
            fclose($clientesCSV);

            # Instrucciones para poder descargar el archivo en el navegador:
            // Indicamos que el archivo es de tipo texto.
            header('Content-Type: text/csv');
            // Esto muestra en el navegador una ventana de descarga para el archivo.
            header('Content-Disposition: attachment; filename="' . $archivoCSV . '"');
            // Esto hace que el navegador lea el archivo y lo envíe al cliente.
            readfile($archivoCSV);
    
            // Eliminar el archivo CSV del servidor
            unlink($archivoCSV);
            exit;
     }

    }

    // Muestra formulario subir archivo
    public function subir($param = []){
        # inicio o continúo sesión
        session_start();
        // Compruebo si el usario de ha autenticado.
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
            
        // Compruebo si el usuario tiene permisos para hace esta acción.
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['subir']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cliente');
        }else{
          
           $this->view->id = $param[0];
           $this->view->title = "Subir archivo";

           if(isset($_SESSION['error'])){
            # Mostramos el mensaje de error
            $this->view->error = $_SESSION['error'];
            // # Autorellena el formulario de nuevo con los datos almacenados en la "sesión cliente" a través del método "unserialize"
            // $this->view->cliente = unserialize($_SESSION['cliente']);
            # Recuperamos el array que contiene los errores específicos.
            $this->view->errores = $_SESSION['errores'];
            # Eliminamos las variables de sesión
            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cliente']);


        }
           $this->view->render('cliente/subir/index');
        }
    }

    // Envía archivo cargado en el formulario a la carpeta CSV del proyecto
    public function enviarCSVCarpeta($param = []){
        # inicio o continúo sesión
        session_start();
    
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['enviarCSVCarpeta']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cliente');

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

        // Compruebo que se ha recibido un archivo.
        if(isset($_FILES['archivo'])){
            $archivo = $_FILES['archivo'];
            $errores = [];
            
            // Compruebo el valor del parámetro error del archivo.
            foreach ($archivo['error'] as $key => $error) {
                 // Si el parámetro error es distinto a 0, algo ha ido mal.
                if($error !== UPLOAD_ERR_OK){
                    $errores['archivo'] = $phpFileUploadErrors[$error];
                    // Si todo ha ido bien, compruebo que contiene el nombre temporal.
                } elseif(is_uploaded_file($archivo['tmp_name'][$key])) {
                     // La clase splFileInfo analiza el archivo y comprueba qué tipo de archivo es.
                    $info = new SplFileInfo($archivo['name'][$key]);
                    $tiposPermitidos = ['csv']; // Permitir solo archivos CSV
                     // strtolower convierte la cadena a minúscula. getExtension, me dice la extensión del archivo que he subido. Comprueba que esa extensión está $tiposPermitidos.
                    if(!in_array(strtolower($info->getExtension()), $tiposPermitidos)){
                        $errores['archivo'] = "Tipo de archivo no permitido.";
                    }
                }
            }
        
            if(!empty($errores)){
                $_SESSION['error'] = 'Error al subir el archivo.';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'cliente/subir');
            } else {
                // Aquí cambia el nombre temporal por el nombre del propio archivo y lo mueve a la carpeta CSV del proyecto.
                foreach ($archivo['name'] as $index => $nombreArchivo) {
                    move_uploaded_file($archivo['tmp_name'][$index], 'CSV/' . $nombreArchivo);
                    // Procesar el archivo después de moverlo
                    $this->importarCSV($nombreArchivo);
                }
                $_SESSION['mensaje'] = 'Archivo subido con éxito';
                header('location:' . URL . 'cliente');
            }
            }
            }
        }  



        function importarCSV($nombreArchivo){
            # inicio o continúo sesión
           session_start();

           if (!isset($_SESSION['id'])) {
               $_SESSION['mensaje'] = "Usuario debe autentificarse";
               header("location:" . URL . "login");
           } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['enviarCSVCarpeta']))) {
               $_SESSION['mensaje'] = "Operación sin privilegios";
               header('location:' . URL . 'cliente');

           }else{
              
               $archivo = URL . 'CSV/' . $nombreArchivo;
               # Obtenemos el contenido del archivo
               $contenido = file_get_contents($archivo);
               $lineas= explode("\n", $contenido);

               foreach($lineas as $linea){
                   $campos = str_getcsv($linea);
                   $apellidos = $campos[0];
                   $nombre = $campos[1];
                   $telefono = $campos[2];
                   $ciudad = $campos[3];
                   $dni = $campos[4];
                   $email = $campos[5];
                   
                   $cliente = new classCliente(
                       null,
                       $apellidos,
                       $nombre,
                       $telefono,
                       $ciudad,
                       $dni,
                       $email);

                     $this->model->create($cliente);
                       # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
                       $_SESSION['mensaje'] = 'Cliente CSV creado correctamente.';
                       # Nos redirige al main de cliente.
                       header('location:' . URL . 'cliente');   
               }
               }
            }

            function PDF(){

                 # inicio o continúo sesión
                session_start();
                // Compruebo si el usario de ha autenticado.
                if (!isset($_SESSION['id'])) {
                    $_SESSION['mensaje'] = "Usuario debe autentificarse";
                    header("location:" . URL . "login");
                   
                // Compruebo si el usuario tiene permisos para hace esta acción.
                } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cliente']['PDF']))) {
                    $_SESSION['mensaje'] = "Operación sin privilegios";
                    header('location:' . URL . 'cliente');
                    
                }else{
                   // ob_start: esto evita que si hay una salida de datos previa  a la creación del PDF, se guarde en un búfer y no se lance directamente al navegador. Para evitar que el formato del pdf no se vea afectado.
                    ob_start();
                    $pdf = new classPDFCliente();
                    $pdf->SetFont('Arial','',12);
                    $pdf->AliasNbPages();
                    $pdf->addPage();
                    // $pdf->Header();
                    $pdf->titulo();
                    $pdf->encabezado();
                    
                    $clientes = $this->model->get();
                    
                    foreach($clientes as $cliente){
                        $pdf-> Cell(15, 10, iconv('UTF-8','UTF-8', $cliente->id),1,0,'C');
                        $pdf-> Cell(70, 10, iconv('UTF-8','UTF-8', $cliente->cliente),1,0,'C');
                        $pdf-> Cell(30, 10, iconv('UTF-8','UTF-8', $cliente->telefono),1,0,'C');
                        $pdf-> Cell(30, 10, iconv('UTF-8','UTF-8', $cliente->dni),1,0,'C');
                        $pdf-> Cell(50, 10, iconv('UTF-8','UTF-8', $cliente->email),1,0,'C');
                        $pdf->Ln();
                        // Esto añade encbezado de tabla a cada página que se crea.
                        if ($pdf->GetY() > 250) {
                            $pdf->addPage();
                            $pdf->encabezado();
                        }
                    }
                    // $pdf->Footer();
                    // ob_clean: Borra los posibles datos almacenados en el búfer con ob_start.
                    ob_clean();
                    $pdf->Output();
                    // ob_end_flush: envía el bufer de salida con los datos actuales.
                    ob_end_flush();


            }
                  
        }
    }
?>