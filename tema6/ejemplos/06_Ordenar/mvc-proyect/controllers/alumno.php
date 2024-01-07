<?php

    class Alumno Extends Controller {

        function __construct() {

            parent ::__construct();
            
            
        }

        function render() {

            # Creo la propiedad title de la vista
            $this->view->title = "Home - Panel Control Alumnos";
            
            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->alumnos = $this->model->get();

            $this->view->render('alumno/main/index');
        }

        function new() {

            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Alumnos";

            #  obtener los cursos  para generar dinámicamente lista cursos
            $this->view->cursos = $this->model->getCursos();

            # cargo la vista con el formulario nuevo alumno
            $this->view->render('alumno/new/index');
        }

        function create ($param = []) {
            
            # Cargamos los datos del formulario
            $alumno = new classAlumno(
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

            # Validación

            # Añadir registro a la tabla
            $this->model->create($alumno);

            # Redirigimos al main de alumnos
            header('location:'.URL.'alumno');
        }

        function edit($param = []) {

            # obtengo el id del alumno que voy a editar
            // alumno/edit/4

            $id = $param[0];

            # asigno id a una propiedad de la vista
            $this->view->id = $id;

            # title
            $this->view->title = "Editar - Panel de control Alumnos";

            # obtener objeto de la clase alumno
            $this->view->alumno = $this->model->read($id);

            # obtener los cursos
            $this->view->cursos = $this->model->getCursos();

            # cargo la vista
            $this->view->render('alumno/edit/index');



        }

        public function update($param = []) {

            #Cargo el id del alumno
            $id = $param[0];

            #Con los detalles del formulario creo el objeto alumno
            $alumno = new classAlumno(
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

            #Actualizo 
            $this->model->update($alumno, $id);

            #CArgo el conttrolador principal de alumno
            header('location:'.URL.'alumno');

        }

        public function order($param = []){
            # Obtengo criterio de ordenación
            $criterio = $param[0];
             # Creo la propiedad title de la vista
             $this->view->title = "Ordenar - Panel Control Alumnos";
            
             # Creo la propiedad alumnos dentro de la vista
             # Del modelo asignado al controlador ejecuto el método ordenar();
             $this->view->alumnos = $this->model->order($criterio);
 
             #Cargo la vista principal del alumno
             
             $this->view->render('alumno/main/index');

        }
    }

?>