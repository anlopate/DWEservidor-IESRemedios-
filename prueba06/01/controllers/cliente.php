<?php
    class Cliente extends Controller{
        function __construct(){
            parent::__construct();
        }

        // Método render, se ejecuta si no hay parametros
        function render(){
            // Añadimos un título a la vista
            $this->view->title = "Tabla Clientes";

            // Creamos la propiedad clientes dentro de la vista, y ejecutamos el método get
            $this->view->clientes = $this->model->get();

            // Cargamos la vista cliente
            $this->view->render('cliente/main/index');
        }

        // Método new, donde saldrá un formulario
        function new(){
            // Añadimos un titulo a la vista
            $this->view->title = "Añadir - Gestión Clientes";

            // Cargamos la vista con el formulario correspondiente
            $this->view->render('cliente/new/index');
        }

        // Método create, introduce un nuevo cliente a la base de datos
        function create($param=[]){
            // Cargamos los datos del formulario
            $cliente = new classCliente(null,
            $_POST['apellidos'],
            $_POST['nombre'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
            $_POST['email']);

            // Añadimos el registro a la tabla
            $this->model->create($cliente);

            // Redireccionamos
            header('Location:'.URL.'cliente');
        }

        // Método edit, editar un registro de la base de datos
        function edit($param = []){
            // obtenemos el id del cliente
            $id = $param[0];

            // Creamos una propiedad de la vista llamada id
            $this->view->id = $id;

            // Asignamos un título a la página
            $this->view->title = 'Editar - Gestión Clientes';

            // Obtenemos un objeto de la clase cliente
            $this->view->cliente = $this->model->read($id);

            // Cargamos la vista con el formulario correspondiente
            $this->view->render('cliente/edit/index');
        }

        // Método update
        function update($param = []){
            //Obtenemos el id del cliente
            $id = $param[0];

            // Asignamos el id a una propiedad de la vista
            $this->view->id = $id;

            // Cargamos los datos del formulario
             $cliente = new classCliente(null,
             $_POST['apellidos'],
             $_POST['nombre'],
             $_POST['telefono'],
             $_POST['ciudad'],
             $_POST['dni'],
             $_POST['email']);

             // Actualizamos el registro de la base de datos
             $this->model->update($id,$cliente);

             // Redireccionamos
             header("Location:".URL."cliente");
        }


        // Método delete, elimina a un cliente según su id
        function delete($param=[]){
         //Obtenemos el id del cliente
         $id = $param[0];

         // Asignamos el id a una propiedad de la vista
         $this->view->id = $id;

         // Eliminamos el registro de la base de datos
         $this->model->delete($id);

         // Redireccionamos
         header("Location:".URL."cliente");

        }

        // Método show, muetra los datos de un cliente
        function show($param=[]){
            // Obtenemos el id del cliente
            $id = $param[0];

            // Creamos una propiedad llamada id a la vista
            $this->view->id = $id;

            // Añadimos un propiedad llamada title
            $this->view->title = "Datos del cliente";

            // Obtenemos un objeto de la clase cliente
            $this->view->cliente = $this->model->read($id);

            // Cargamos la vista con los datos del cliente
            $this->view->render('cliente/show/index');
        }


        // Método order
        function order($param=[]){
            // Obtenemos el criterio de Ordenacion
            $criterio = $param[0];

            // Añadimos una propiedad title a la vista
            $this->view->title = 'Ordenar - Tabla Clientes';

            // Creamos la propiedad cliente dentro de la vista, y ejecutamos el método order del modelo
            $this->view->clientes = $this->model->order($criterio);

            // Cargamos la vista de clientes
           $this->view->render('cliente/main/index');
        }

        // Método filter
        function filter($param=[]){
            // Capturamos la expresión a través del método GET
            $expresion = $_GET['expresion'];

            // Creamos la propiedad title en la vista
            $this->view->title = 'Filtrar - Tabla Clientes';

            // Creamos en la vista la propiedad clientes, y ejecutamos el método filter del modelo cliente
            $this->view->clientes = $this->model->filter($expresion);

            // Cargamos la vista principal de clientes
            $this->view->render('cliente/main/index');
        }
    }
?>