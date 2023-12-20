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

        function create ($param = []){
            #Cargamos los datos del formulario y los asignamos a los parámetros del constructor de la clase. Los parámetros a null son porque no se han solicitado al crear un alumno para mostrar.
            $alumno = new classAlumno (
                null,
                $_POST['nombre'],
                $_POST['apellidos'],
                $_POST['email'],
                $_POST['telefono'],
                null,
                $_POST['poblacion'],
                null,
                null,
                $_POST['dni'],
                $_POST['fechaNac'],
                $_POST['id_curso']
            );
                
          #Añadir registros a la tabla
          
          $this->model->create($alumno);

          #Redirigimos al main de alumnos

          header('location:'.URL.'alumno'); 
        }

        function edit($param = []){

            #Obtengo el id del alumno que voy a editar
             //alumno/edit/4, edita el alumno numero 4. alumno es el controlador, edit es el método y 4 es el parámetro en un array.
             
             $id = param[0];//el id del alumno es un arra
             #asigno id a una propiedad de la vista
             $this->view->id = $id;

             #title
             $this->view->title = "Editar - panel de control Alumnos";

             #Obtener objeto de la clase alumno

             $this->view->alumno = $this->model->read($id);

             #Obtener cursos
             $this->vies->cursos = $this->model->getCursos();

             #cargo la vista
             $this->view->render('alumno/edit/index');



        }

        function show($param = []){ //En este tipo de programación, se Recibe la información a través de un array

        }


    }

#En la función new los casos $this->view->title, está creando al objeto view, un atributo en modo ejecución llamado title. 
#En $this->view->cursos, se creado el atributo cursos en mode ejecución.

?>

