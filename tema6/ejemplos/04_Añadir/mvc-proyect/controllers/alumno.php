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


        function new(){//método para crear un nuevo alumno. Todas las variables que queramos ver en la vista hay que crearlas aquí.

            #Etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Alumnos"; //Enviamos la etiqueta title que va a tener la vista 
            #Obtener cursos para generar dinámicamente la lista cursos
            $this->view->cursos = $this->model->getCursos(); //$this->view->cursos es como una variable que alamcena los cursos para usar en la vista y mostrar los cursos en el desplegable
            #Carga la vista con el formulario nuevo alumno
            $this->view->render('alumno/new/index');
        }

        function show($param = []){

        }
    }

?>