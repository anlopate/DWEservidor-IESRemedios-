<?php
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
                $errores['ciudad'] = 'El campor es obligatorio';
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

       
        function edit($param = []){
            
             # Iniciamos o continuamos sesión
             session_start();
              # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
            }else{   
             # Obtenemos el id del cliente que queremos editar
            $id = $param[0];
            # Asignamos id a la propiedad de la vista id para mostrat los datos que correspoden a es id.
            $this->view->id = $id;
            # Título de la página.
            $this->view->title = 'Editar - Gestión Clientes';
            # Obtenemos el cliente solicitado a través del método read del modelo.
            $this->view->cliente = $this->model->read($id);
            # Mostramos los datos del cliente.
            $this->view->render('cliente/edit/index');

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
        }
    }
        function update($param = []){

            # Iniciamos o continuamos sesión
            session_start();
             # Comprobar si el usuario está autentificado
             if(!isset($_SESSION['id'])) {
                $_SESSION['notify'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');
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
            # En caso de que se inserte algún dato incorrecto, se cragará en el array 'errore'.

            // Apellidos: obligatorio y tamaño max 45 caractere.
            if(empty($apellidos)){
                $errores['apellidos'] = 'El campor es obligatorio';
            }else if(strlen($apellidos)>45 ){
                $errores['apellidos'] = 'El campo es demasiado largo';
            }

            // Nombre: obligatorio y tamaño max 20 caracteres.
            if(empty($nombre)){
                $errores['nombre'] = 'El campor es obligatorio';
            }else if(strlen($nombre)>20){
                $errores['nombre'] = 'El campo es demasiado largo';
            }

             // Teléfono: No obligatorio y tamaño max 9 dígitos.
             if(strlen($telefono)>9){
                 $errores['telefono'] = 'El campo es demasiado largo';
            }

            // Ciudad: obligatorio y tamaño max 20 caracteres.
            if(empty($ciudad)){
                $errores['ciudad'] = 'El campor es obligatorio';
            }else if(strlen($ciudad)>20) {
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
                // Nos muestra los datos del cliente.
                $_SESSION['cliente'] = serialize($cliente);
                // Mensaje de error a mostrar en el formulario.
                $_SESSION['error'] = 'Formulario no ha sido validado';
                // Errores que aparecen en el formulario.
                $_SESSION['errores'] = $errores;

                # Nos redirige de nuevo al formulario.
                header('location:'. URL . 'cliente/new');
            }else{
                # Si el formulario ha sido validado.
                # Se crea un nuevo cliente en la BBDD a través del método create del modelo.
                $this->model->create($cliente);
                # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
                $_SESSION['mensaje'] = 'Cliente creado correctamente.';
                # Nos redirige al main de cliente.
                header('locatio:' . URL . 'cliente');
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

       
        function filter($param=[]){
           
            $expresion = $_GET['expresion'];

            $this->view->title = 'Filtrar - Tabla Clientes';

            $this->view->clientes = $this->model->filter($expresion);

            $this->view->render('cliente/main/index');
        }
    }
    
    
?>