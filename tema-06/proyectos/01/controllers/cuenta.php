<?php
      
    class Cuenta extends Controller{

        function __construct(){
            parent ::__construct();
        }
   

    function render() {

       
        $this->view->title = "Tabla Cuentas";
        $this->view->cuentas = $this->model->get();
        $this->view->render('cuenta/main/index');
    }

    function new (){

        $this->view->title = "Añadir - Gestión Cuentas";
        $this->view->listaClientes = $this->model->obtenerCliente();
        $this->view->render('cuenta/new/index');
    }

    public function create(){
        
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $_POST['id_cliente'],
            null,
            null,
            null,
            $_POST['saldo'],

        );

        $this->model->create($cuenta);
        header('location:' . URL . 'cuenta');
    }


    public function edit($param = []){
       
        $id_editar = $param[0];
        $this->view->id = $id_editar;

        $this->view->title = "Editar Cuenta - Panel de control Cuentas";
        $this->view->cuenta = $this->model->read($id_editar);
        $this->view->listaClientes = $this->model->obtenerCliente();
        $this->view->render('cuenta/edit/index');
       
    }


    public function update($param = []) {

        $id_editar = $param[0];
        $cuenta = new classCuenta(
            null,
            $_POST['num_cuenta'],
            $id_editar,
            $_POST['fecha_alta'],
           /* $_POST['fecha_ul_mov'],
            $_POST['num_movtos'],*/
            $_POST['saldo'],
        );
        $this->model->update($id_editar, $cuenta);
        header('location:' . URL . 'cuenta');

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