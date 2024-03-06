<?php
    // require ('fpdf/fpdf.php');
    require('class/classPDFCliente.php');
    require('models/cuentaModel.php');
    require('class/classMovimiento.php');

   class Movimientos extends Controller{
            function __construct(){
                parent::__construct();
            }

            

    function render($param=[]){

        # Iniciamos o continamo sesión
        session_start();

        # Comprobar si el usuario está autentificado
        if(!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = 'Usuario debe autentificarse';
            header('location:'. URL . 'login');
        # Pregunta si tiene privilegios para identificarse.
        }else if (!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['main'])){
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:'.URL.'index');
        }else{    
        # Comprobamos si en la sesión existe un mensaje. 
        # Si existe lo mostramos, y a continuación lo borramos.
        if(isset($_SESSION['mensaje'])){
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
        }

        $id = $param[0];
        # Titulo de la página
        $this->view->title = "Tabla Movimientos";

        # Creo la propiedad mvtos dentro de la vista del modelo.
        # Del modelo asigando al controlador, ejecuto el método get().
        $this->view->movimientos = $this->model->get($id);

        # La vista nos envío al main de mvtos
        $this->view->render('movimientos/main/index');
        
    }
}

function new(){

    # Abrimos o continuamos sesión.
    session_start();

     # Comprobar si el usuario está autentificado
     if(!isset($_SESSION['id'])) {
        $_SESSION['notify'] = 'Usuario debe autentificarse';

        header('location:'. URL . 'login');
    }else if(!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['new'])){ 
        $_SESSION['mensaje'] = "Operación sin privilegios";
        header('location:'.URL.'movimientos');
    }else{   
   
    # Creamos un objeto Movimiento vacío.
    $this->view->movimientos = new classMovimiento();

    # Comprobamos si el formulario contiene algún error, es decir, no ha sido validado.
    if(isset($_SESSION['error'])){

        # Mostramos el mensaje de error
        $this->view->error = $_SESSION['error'];

        # Autorellena el formulario de nuevo con los datos almacenados en la "sesión movimiento" a través del método "unserialize"
        $this->view->movimiento = unserialize($_SESSION['movimientos']);

        # Recuperamos el array que contiene los errores específicos.
        $this->view->errores = $_SESSION['errores'];

        # Eliminamos las variables de sesión
        unset($_SESSION['error']);
        unset($_SESSION['errores']);
        unset($_SESSION['movimientos']);


    }
    
    # Título de la página.
    $this->view->title = "Añadir - Gestión Movimientos";
    //  # Obtenemos la lista de clientes para insertar en la nueva cuenta.
    $this->view->listaCuentas = $this->model->obtenerCuenta();

    # Carga vista con el formulario de nuevo cliente.
    $this->view->render('movimientos/new/index');
}
}

function create(){

    # Iniciamo o contianuamo sesión.
    session_start();

     # Comprobar si el usuario está autentificado
     if(!isset($_SESSION['id'])) {
        $_SESSION['notify'] = 'Usuario debe autentificarse';

        header('location:'. URL . 'login');
    }else if(!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['new'])){ 
        $_SESSION['mensaje'] = "Operación sin privilegios";
        header('location:'.URL.'movimientos');
    }else{   
    # Por seguridad saneamos los datos del formulario para evitar posibles inyecciones de código a la bbdd no deseado.
    $id_cuenta = filter_var($_POST['id_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
    $fecha_hora = filter_var($_POST['fecha_hora'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
    $concepto = filter_var($_POST['concepto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
    $tipo = filter_var($_POST['tipo'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
    $cantidad = filter_var($_POST['cantidad'] ??= '', FILTER_SANITIZE_NUMBER_INT);
   
  
     # Obtengo el saldo de la cuenta  a través del id por medio de la función del modelo
     $saldo = $this->model->conocerSaldoCuenta($id_cuenta);   
    # Validación de datos.
    # Creamos un array de errores donde se almacenarán los posibles errores que contenga el formulario.
    $errores = [];

    # Indicamos los posibles errores que pueden aparecer en cada campor del formulario.
    # En caso de que se inserte algún dato incorrecto, se cragará en el array 'errore'.

    // Cuenta: obligatoria, válida y existente.
    if(empty($id_cuenta)){
        $errores['id_cuenta'] = 'El campo es obligatorio';
    }else if(!$this->model->validarCuenta($id_cuenta)){
        $errores['id_cuenta'] = 'El número de cuenta no existe';
    }

     // Concepto: obligatorio y valor max 50 dígitos.
     if(empty($concepto)){
        $errores['concepto'] = 'El campo es obligatorio';
     }else if(strlen($concepto)>50){
         $errores['concepto'] = 'El campo es demasiado largo';
    }

    // Tipo: obligatorio. Solo valor I o R, ingreso o reintegro.
    if(empty($tipo)){
        $errores['tipo'] = 'El campo es obligatorio';
    }else if($tipo != "I" && $tipo != "R"){
        $errores['tipo'] = 'El valor introducido no es válido';
    }
    
    // Cantidad: no podrá ser mayor que el saldo.
    if(empty($cantidad)){
        $errores['cantidad'] = 'El campo es obligatorio';
    }else if($saldo < $cantidad){
        $errores['cantidad'] = 'Cantidad no disponible.';
    }

    # Comprobamos validación.
    # Si el array errores contiene algún dato, quiere decir que no se ha realizado la validación.
    # En ese caso se crean diferentes variables de Session que se moostrarán de nuevo en el formulario.
    if(!empty($errores)){
        
        $_SESSION['movimientos'] = serialize($movimiento);
        // Mensaje de error a mostrar en el formulario.
        $_SESSION['error'] = 'Formulario no ha sido validado';
        // Errores que aparecen en el formulario.
        $_SESSION['errores'] = $errores;

        # Nos redirige de nuevo al formulario.
        header('location:'. URL . 'movimientos/new');
    }else{
        
        $nuevo_saldo = $saldo - $cantidad;

        $mov_actualizado = new classMovimiento(
            null,
            $id_cuenta,
            $fecha_hora,
            $concepto,
            $tipo, 
            $cantidad,
            $nuevo_saldo
        );
        # Si el formulario ha sido validado.
        # Se crea una nuevo cliente en la BBDD a través del método create del modelo.
        $this->model->create($mov_actualizado);
        # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
        $_SESSION['mensaje'] = 'Movimiento creado correctamente.';
        # Se actualiza el saldo de la cuenta correspondiente y el numero de movimientos.
        $this->model->actualizarCuenta($id_cuenta, $nuevo_saldo);
        $_SESSION['mensaje'] = 'Movimiento creado correctamente.';
        # Nos redirige al main de cliente.
        header('location:' . URL . 'movimientos/render/'. $id_cuenta);
    }
}
}

        function order($param=[]){

            # Inicio o continúo sesión, en este caso del create
            session_start();

        # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = 'Usuario debe autentificarse';

                header('location:'. URL . 'login');

            }else if(!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['order'])){ 
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:'.URL.'cuenta');
            }
            else{
        # Obtenemos criterio de ordenación.
        $criterio = $param[0];
        # Título de la página.
        $this->view->title = 'Ordenar - Tabla Movimientos';
        # Creamos la propiedad clientes dentro de la vista.
        # Ejecutamos el método order.
        $this->view->movimientos = $this->model->order($criterio);
        # Se carga la vista principal del cliente.
        $this->view->render('movimientos/main/index');
        }
        }

        function filter($param=[]){
           
            # inicio o continúo sesión
            session_start();
   
            if (!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = "Usuario debe autentificarse";
                header("location:" . URL . "login");
            } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['filter']))) {
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:' . URL . 'cuenta');
            } else {
           $expresion = $_GET['expresion'];
   
           $this->view->title = 'Filtrar - Tabla Movimientos';
   
           $this->view->movimientos = $this->model->filter($expresion);
   
           $this->view->render('movimientos/main/index');
       }
    }  


    function show($param=[]){

        # Iniciamos o continuamos sesión.
        session_start();
 
        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {
          $_SESSION['mensaje'] = "Usuario No Autentificado";
 
          header("location:" . URL . "login");
      } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['movimientos']['main']))) {
          $_SESSION['mensaje'] = "Operación sin privilegios";
          header('location:' . URL . 'cuenta');
      }else{
            
         $id = $param[0];
 
         $this->view->id = $id;
 
         $this->view->title = "Datos del movimiento";
 
         $this->view->movimiento = $this->model->read($id);
        
 
         $this->view->render('movimientos/show/index');
     }
    }

}

?>