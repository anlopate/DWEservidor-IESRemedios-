<?php

    class Alumno Extends Controller {

        function __construct() {

            parent ::__construct();
           
            //Se puede quitar porque hereda el constructor de la clase padre.
            
        }

        function render() {//vista asociada al controlador. Se ejecuta si en la URL escribimos alumno sin parámetros detrás

            $this->view->nombre = "Juan"; //crear una variable que luego voy a utilizar en la vista. Creo la propiedad nombre dentro de la vista y le asignamos un valor.
            $this->view->apellido = "Moreno Jiménez"; 

            $this->view->render('alumno/main/index');
        }


        function new(){//método para crear un nuevo alumno
            $this->view->render('alumno/new/index');
        }

        function show($param = []){

        }
    }

?>