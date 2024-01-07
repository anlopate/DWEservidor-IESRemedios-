<?php
    class Cliente extends Controller{
        function __construct(){
            parent::__construct();
        }

       
        function render(){
         
            $this->view->title = "Tabla Clientes";
            $this->view->clientes = $this->model->get();
            $this->view->render('cliente/main/index');
        }

       
        function new(){
           
            $this->view->title = "Añadir - Gestión Clientes";
            $this->view->render('cliente/new/index');
        }

      
        function create($param=[]){
          
            $cliente = new classCliente(
                null,
            $_POST['apellidos'],
            $_POST['nombre'],
            $_POST['telefono'],
            $_POST['ciudad'],
            $_POST['dni'],
            $_POST['email']);
        
            $this->model->create($cliente);
            header('location:'.URL.'cliente');
        }

       
        function edit($param = []){
            
            $id = $param[0];
            $this->view->id = $id;

            $this->view->title = 'Editar - Gestión Clientes';
            $this->view->cliente = $this->model->read($id);

            $this->view->render('cliente/edit/index');
        }

        function update($param = []){
           
            $id = $param[0];

            $this->view->id = $id;

             $cliente = new classCliente(
                null,
             $_POST['apellidos'],
             $_POST['nombre'],
             $_POST['telefono'],
             $_POST['ciudad'],
             $_POST['dni'],
             $_POST['email']);

             $this->model->update($id,$cliente);

             header("location:".URL."cliente");
        }


      
        function delete($param=[]){
        
         $id = $param[0];
         $this->view->id = $id;

         $this->model->delete($id);

         header("Location:".URL."cliente");

        }

       
        function show($param=[]){
           
            $id = $param[0];

            $this->view->id = $id;

            $this->view->title = "Datos del cliente";

            $this->view->cliente = $this->model->read($id);

            $this->view->render('cliente/show/index');
        }


        function order($param=[]){
           
            $criterio = $param[0];

            $this->view->title = 'Ordenar - Tabla Clientes';
            $this->view->clientes = $this->model->order($criterio);

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