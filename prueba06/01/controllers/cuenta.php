<?php
      
    class Cuenta extends Controller{

        function __construct(){
            parent ::__construct();
        }
   

    function render() {

        # Creo la propiedad title de la vista
        $this->view->title = "Home - Panel Control Cuentas";
        
        # Creo la propiedad alumnos dentro de la vista
        # Del modelo asignado al controlador ejecuto el método get();
        $this->view->cuentas = $this->model->get();

        $this->view->render('cuenta/main/index');
    }

    function new (){

        $this->view->title = "Nuevo - Gestión Cuentas";

        $this->view->render('cuenta/new/index');
    }

    function create () {
            
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $_POST['id_cliente'],
            $_POST['fecha_alta'],
            $_POST['saldo'],

        );

       
        $this->model->create($cuenta);

        header('location:'.URL.'cuenta');
    }

 }  
?>