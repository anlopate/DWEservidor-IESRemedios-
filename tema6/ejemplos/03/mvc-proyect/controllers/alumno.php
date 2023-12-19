<?php

    class Alumno Extends Controller {

        function __construct() {

            parent ::__construct();
           
            //Se puede quitar porque hereda el constructor de la clase padre.
            
        }

        function render() {//vista asociada al controlador. Se ejecuta si en la URL escribimos alumno sin parámetros detrás

            //Creo la propiedad alumnos dentro de la vista
            //Del modelo asignado al controlador ejecuto el método get()
           $this->view->alumnos = $this->model->get();//alumnos es un objeto de la clase pdostmt que devuelve el metodo get de model alumno

            $this->view->render('alumno/main/index');
        }


        function new(){//método para crear un nuevo alumno
            $this->view->render('alumno/new/index');
        }

        function show($param = []){

        }
    }

?>