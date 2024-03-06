<?php

require 'controllers/perfil.php';
class Usuario extends Controller{
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
        }else if (!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['main'])){
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
        $this->view->title = "Tabla Usuarios";

        # Creo la propiedad clientes dentro de la vista del modelo.
        # Del modelo asigando al controlador, ejecuto el método get().
        $this->view->usuarios = $this->model->get();

        # La vista nos envío al main de cliente
        $this->view->render('usuario/main/index');
    }
}

function new(){

    # Abrimos o continuamos sesión.
    session_start();

     # Comprobar si el usuario está autentificado
     if(!isset($_SESSION['id'])) {
        $_SESSION['notify'] = 'Usuario debe autentificarse';

        header('location:'. URL . 'login');
    }else if(!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['new'])){ 
        $_SESSION['mensaje'] = "Operación sin privilegios";
        header('location:'.URL.'usuario');
    }else{   
   
    # Creamos un objeto Cliente vacío.
    $this->view->usuario = new classUser();

    # Comprobamos si el formulario contiene algún error, es decir, no ha sido validado.
    if(isset($_SESSION['error'])){

        # Mostramos el mensaje de error
        $this->view->error = $_SESSION['error'];

        # Autorellena el formulario de nuevo con los datos almacenados en la "sesión cliente" a través del método "unserialize"
        $this->view->usuario = unserialize($_SESSION['usuario']);

        # Recuperamos el array que contiene los errores específicos.
        $this->view->errores = $_SESSION['errores'];

        # Eliminamos las variables de sesión
        unset($_SESSION['error']);
        unset($_SESSION['errores']);
        unset($_SESSION['usuario']);


    }
    # Título de la página.
    $this->view->title = "Añadir - Gestión Usuarios";

    # Carga vista con el formulario de nuevo cliente.
    $this->view->render('usuario/new/index');
}
}

public function create() {

    # Iniciamos o continuamos con la sesión
    session_start();

    # Saneamos el formulario
    $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
    $password_confirm = filter_var($_POST['password-confirm'],FILTER_SANITIZE_SPECIAL_CHARS);

    # Validaciones

    $errores = array();

    # Validar name
    if(empty($name)){
        $errores['name'] = "Campo obligatorio";
    }else if (!$this->model->validateName($name)){
        $errores['name'] = "Nombre de usuario no permitido";
    }
    # Validar Email
    if(empty($email)){
        $errores['email'] = "Campo obligatorio";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = "Email: Email no válido";
    } elseif (!$this->model->validateEmailUnique($email)) {
        $errores['email'] = "Email existente, ya está registrado";
    }

    # Validar password
    if(empty($password)){
        $errores['password'] = "Campo obligatorio";
    }else if (strcmp($password, $password_confirm) !== 0) {
        $errores['password'] = "Password no coincidentes";
    } else if (!$this->model->validatePass($password)) {
        $errores['password'] = "Password: No permitido";
    }

    if (!empty($errores)) {

        $_SESSION['errores'] = $errores;
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        $_SESSION['error'] = "Fallo en la validación del formulario";
        
        header("location:". URL. "register");

    } else {
        
        # Añade nuevo usuario
        $this->model->create($name, $email, $password);

        $_SESSION['mensaje'] = "Usuario registrado correctamente";
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password; 

        #Vuelve login
        header("location:". URL. "usuario");
    }
}

public function edit($param = []){

    # Iniciamos o continuamos sesión.
    session_start();

     //Comprobar si el usuario está identificado
     if (!isset($_SESSION['id'])) {
      $_SESSION['mensaje'] = "Usuario No Autentificado";

      header("location:" . URL . "login");
  } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['main']))) {
      $_SESSION['mensaje'] = "Operación sin privilegios";
      header('location:' . URL . 'usuario');
  }else{
    # Obtenemos el id de la cuenta que queremos editar.
    $id = $param[0];
    # Asiganmos id a la propiedad 'id' de la vista.
    $this->view->id = $id;

     # Título de la página.
     $this->view->title = "Editar usuario";

     # Recuperamos los datos de la cuenta según id.
     $this->view->usuarios = $this->model->read($id);

    //  # Obtenemos el nombre de los clientes.
    //  $this->view->listaClientes = $this->model->obtenerCliente();

         # Comprobar si vuelvo de un registro no validado
         if (isset($_SESSION['error'])){

             # Mensaje de error
             $this->view->error = $_SESSION['error'];

             # Autorellenar el formulario

             $this->view->usuario = unserialize($_SESSION['cuenta']); 
             # Recupero array errores específicos
             $this->view->errores = $_SESSION['errores'];

             # Elimino las variables de sesión
             unset($_SESSION['error']);
             unset($_SESSION['errores']);
             unset($_SESSION['usuario']);
     }

         # cargo la vista
         $this->view->render('usuario/edit/index');
     }
   }

   function update($param = []){

      # Iniciamos o continuamos con la sesión
      session_start();

      # Capa autentificación
      if (!isset($_SESSION['id'])) {

          header("location:".URL. "usuario/edit");
      }

      # Saneamos el formulario
      $name = filter_var($_POST['name'] ??= null, FILTER_SANITIZE_SPECIAL_CHARS);
      $email = filter_var($_POST['email'] ??= null,FILTER_SANITIZE_EMAIL);
     
      # Obtenemos objeto con los detalles del usuario
      $id = $param[0];
      $user = $this->model->read($id);
      # Validaciones
      $errores = [];

      // name
      if (strcmp($user->name, $name) !== 0) {
          if (empty($name)) { 
              $errores['name'] = "Nombre de usuario es obligatorio";
          } else if ((strlen($name) < 5) || (strlen($name) > 50)) {
              $errores['name'] = "Nombre de usuario ha de tener entre 5 y 50 caracteres";}
          } else if (!$this->model->validateName($name)) {
              $errores['name'] = "Nombre de usuario ya ha sido registrado";
          }
      
      // email
      if (strcmp($user->email, $email) !== 0) {
          if (empty($email)) { 
              $errores['email'] = "Email es un campo obligatorio";
          } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $errores['email'] = "Email no válido";
          } elseif (!$this->model->validateEmail($email)) {
              $errores['email'] = "Email ya ha sido registrado";
          }
      }
    
            # Crear objeto user
            $user = new classUser(
                $id,
                $name,
                $email

            );

    

      # Comprobamos si hay errores
      if (!empty($errores)) {
          $_SESSION['errores'] = $errores;
          $_SESSION['user'] = serialize($user);
          $_SESSION['error'] = "Formulario con errores de validación";

          header('location:'.URL.'perfil/edit');
           exit(); 
      } else {
          # Actualizamos perfil
          $this->model->update($id, $user);
          $_SESSION['mensaje'] = "Usuario actualizado con éxito";
          header("location:".URL. "usuario");
      }
    }

    function show($param=[]){
            
        $id = $param[0];

        $this->view->id = $id;

        $this->view->title = "Datos del usuario";

        $this->view->usuario = $this->model->read($id);

        $this->view->render('usuario/show/index');
    }

    function delete($param=[]){

        # Inicio o continúo sesión, en este caso del create
        session_start();

        # Comprobar si el usuario está autentificado
        if(!isset($_SESSION['id'])) {
            $_SESSION['notify'] = 'Usuario debe autentificarse';

            header('location:'. URL . 'login');
        }else if(!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['delete'])){ 
           $_SESSION['mensaje'] = "Operación sin privilegios";
           header('location:'.URL.'usuario');
           }else{
               $id = $param[0];
               $this->view->id = $id;

               $this->model->delete($id);
               $_SESSION['mensaje'] = "Usuario borrado correctamente";
               header("location:".URL."usuario");
       }
   }

            
        function order($param=[]){

            # Inicio o continúo sesión, en este caso del create
            session_start();

           # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['order'])){ 
               $_SESSION['mensaje'] = "Operación sin privilegios";
               header('location:'.URL.'usuario');
            }
            else{
           # Obtenemos criterio de ordenación.
           $criterio = $param[0];
           # Título de la página.
           $this->view->title = 'Ordenar - Tabla Usuarios';
           # Creamos la propiedad clientes dentro de la vista.
           # Ejecutamos el método order.
           $this->view->usuarios = $this->model->order($criterio);
           # Se carga la vista principal del cliente.
          $this->view->render('usuario/main/index');
       }
   }


   function filter($param=[]){
    # Inicio o continúo sesión, en este caso del create
    session_start();

    # Comprobar si el usuario está autentificado
    if(!isset($_SESSION['id'])) {
        $_SESSION['notify'] = 'Usuario debe autentificarse';

        header('location:'. URL . 'login');

    }else if(!in_array($_SESSION['id_rol'], $GLOBALS['usuario']['filter'])){ 
       $_SESSION['mensaje'] = "Operación sin privilegios";
       header('location:'.URL.'usuario');
    }
    else{
  
   $expresion = $_GET['expresion'];

   $this->view->title = 'Filtrar - Tabla Usuarios';

   $this->view->usuarios = $this->model->filter($expresion);

   $this->view->render('usuario/main/index');
}
}

    }



?>