<?php
      
    class Cuenta extends Controller{

        function __construct(){
            parent ::__construct();
        }
   

    function render() {

        # Iniciamos o continuamos sesión.
        session_start();

        # Comprobamos si existe un mensaje.
        if(isset($_SESSION['mensaje'])){
        $this->view->mensaje = $_SESSION['mensaje'];
        unset($_SESSION['mensaje']);
        }

       # Título de la página.
        $this->view->title = "Tabla Cuentas";
        # Creamos la propiedad cuentas dentro de la vista.
        # Del modelo asignado al controlador, ejecuto el método get();
        $this->view->cuentas = $this->model->get();
        $this->view->render('cuenta/main/index');
    }

    function new (){

        # Iniciamos o continuamos sesión.
         session_start();

        # Creamos un objeto vacío.
        $this->view->cuenta = new classCuenta();

        # Comprobamos si vuelvo de un registro no validado.
        if (isset($_SESSION['error'])){

        # Mensaje de error
        $this->view->error = $_SESSION['error'];

        # Autorellenar el formulario.
        $this->view->cuenta = unserialize($_SESSION['cuenta']); 

        # Recupero array errores específicos.
        $this->view->errores = $_SESSION['errores'];

        # Elimino las variables de sesión
        unset($_SESSION['error']);
        unset($_SESSION['errores']);
        unset($_SESSION['alumno']);
        }

        # Título de la página.
        $this->view->title = "Añadir - Gestión Cuentas";
        # Obtenemos la lista de clientes para insertar en la nueva cuenta.
        $this->view->listaClientes = $this->model->obtenerCliente();
        # Cargamos la vista con el formulario nueva cuenta.
        $this->view->render('cuenta/new/index');
    }

    public function create(){

         # Iniciamos o continuamos sesión.
         session_start();
        # Por seguridad, saneamos los datos recogidos del formulario para evitar inyecciones de código no deseadas.
        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_var($_POST['id_cliente'] ??= FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta'] ??= FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??= FILTER_SANITIZE_NUMBER_FLOAT);
        # Creamos un objeto 'cuenta' con los datos saneados.
         $cuenta = new classCuenta(
             null,
             $num_cuenta,
             $id_cliente,
             $fecha_alta,
             date("d-m-Y H:i:s"),
              1,
              $saldo, 
             null,
             null
         );

         # Realizamos la validación.
         # Creamos array de errores, donde se almacenarán los errores producidos en el formulario.
         $errores = [];

         //Cuenta: obligatoria, 20 digitos númericos y valor único.
         if(empty($num_cuenta)){
            $errores['num_cuenta'] = 'El campo número de cuenta es obligatorio';
         }else if(strlen($num_cuenta) != 20){
            $errores['num_cuenta'] = 'Número de dígitos de cuenta incorrectos';
         }else if(!ctype_digit($num_cuenta)){
            $errores['num_cuenta'] = 'La cuenta sólo puede tener valores númericos';
         }else if(!$this->model->validateNumCuentaUnique($num_cuenta)){
            $errores['num_cuenta'] = 'El número de cuenta ya existe.';
         }

         // Cliente: obligatorio, valor número, debe existir en la tabla clientes.
         if(empty($id_cliente)){
            $errores['id_cliente'] = 'El campo es oblgatorio.';
         }else if($this->model->clienteExistente($id_cliente)){
            $errores['id_cliente'] = 'El cliente no existe.';
         }else if(!ctype_digit($id_cliente)){
            $errores['id_cliente'] = 'El id debe ser numérico.';
         }
           # Comprobamos validaciones.s
           if(!empty($errores)){
           
            $_SESSION['cuenta'] = serialize($cuenta); 
            $_SESSION['error'] = 'Formulario no ha sido validado.';
            $_SESSION['errores'] = $errores; 

            # Nos redirecciona a new.
            header('location:'. URL.'cuenta/new');
       }else{ 
           $this->model->create($cuenta);
           $_SESSION['mensaje'] = 'Cuenta creada correctamente.';
           header('location:'.URL.'cuenta');  
       }

    }


    public function edit($param = []){

       # Iniciamos o continuamos sesión.
       session_start();
       # Obtenemos el id del alumno que queremos editar.
       $id = $param[0];
       # Asiganmos id a la propiedad 'id' de la vista.
       $this->view->id = $id;

        # Título de la página.
        $this->view->title = "Editar cuenta";

        # Recuperamos los datos de la cuenta según id.
        $this->view->cuenta = $this->model->read($id);

        # Obtenemos el nombre de los clientes.
        $this->view->listaClientes = $this->model->obtenerCliente();

            # Comprobar si vuelvo de un registro no validado
            if (isset($_SESSION['error'])){

            # Mensaje de error
            $this->view->error = $_SESSION['error'];

            # Autorellenar el formulario

            $this->view->cuenta = unserialize($_SESSION['cuenta']); 
            # Recupero array errores específicos
            $this->view->errores = $_SESSION['errores'];

            # Elimino las variables de sesión
            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['alumno']);
        }

            # cargo la vista
            $this->view->render('cuenta/edit/index');
        }

    public function update($param = []) {

        # Iniciamos o continuamos sesión.
        session_start();
        # Por seguridad, saneamos los datos recogidos del formulario para evitar inyecciones de código no deseadas.
        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_var($_POST['id_cliente'] ??= FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alata'] ??= FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??= FILTER_SANITIZE_NUMBER_FLOAT);
        # Creamos un objeto 'cuenta' con los datos saneados.
         $cuenta = new classCuenta(
             null,
             $num_cuenta,
             $id_cliente,
             $fecha_alta,
             date("d-m-Y H:i:s"),
             0,
             $saldo,
             null,
             null
         );

        # Recuperamos id de la cuenta. 
        $id_editar = $param[0];
       # Leemos la cuenta original.
       $cuenta_orig = $this->model->read($id_cliente);
        # Realizamos la validación.
         # Creamos array de errores, donde se almacenarán los errores producidos en el formulario.
         $errores = [];

         //Cuenta: obligatoria, 20 digitos númericos y valor único.
         if(empty($num_cuenta)){
            $errores['num_cuenta'] = 'El campo número de cuenta es obligatorio';
         }else if(strlen($num_cuenta) != 20){
            $errores['num_cuenta'] = 'Número de dígitos de cuenta incorrectos';
         }else if(!ctype_digit($num_cuenta)){
            $errores['num_cuenta'] = 'La cuenta sólo puede tener valores númericos';
         }else if(!$this->model->validateNumCuentaUnique($num_cuenta)){
            $errores['num_cuenta'] = 'El número de cuenta ya existe.';
         }

         // Cliente: obligatorio, valor número, debe existir en la tabla clientes.
         if(empty($id_cliente)){
            $errores['id_cliente'] = 'El campo es oblgatorio.';
         }else if($this->model->clienteExistente($id_cliente)){
            $errores['id_cliente'] = 'El cliente no existe';
         }else if(!ctype_digit($id_cliente)){
            $errores['id_cliente'] = 'El id debe ser numérico.';
         }
           # Comprobamos validaciones.s
           if(!empty($errores)){
           
            $_SESSION['cuenta'] = serialize($cuenta); 
            $_SESSION['error'] = 'Formulario no ha sido validado.';
            $_SESSION['errores'] = $errores; 

            # Nos redirecciona a new.
            header('location:'. URL.'cuenta/edit');
       }else{ 
           $this->model->create($cuenta);
           $_SESSION['mensaje'] = 'Cuenta editada correctamente.';
           header('location:'.URL.'cuenta');  
       }
    }

    function delete($param=[]){
        
        $id = $param[0];
        $this->view->id = $id;

        $this->model->delete($id);

        header("location:".URL."cuenta");

       }

       function show($param=[]){
           
        $id = $param[0];

        $this->view->id = $id;

        $this->view->title = "Datos de la cuenta";

        $this->view->cuenta = $this->model->read($id);

        $this->view->render('cuenta/show/index');
    }


    function order($param=[]){
           
        $criterio = $param[0];

        $this->view->title = 'Ordenar - Tabla Cuentas';
        $this->view->cuentas = $this->model->order($criterio);

       $this->view->render('cuenta/main/index');
    }

    function filter($param=[]){
           
        $expresion = $_GET['expresion'];

        $this->view->title = 'Filtrar - Tabla Cuentas';

        $this->view->cuentas = $this->model->filter($expresion);

        $this->view->render('cuenta/main/index');
    }

 }  
?>