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

        function new() { //Muestra el formulario.

            # etiqueta title de la vista
            $this->view->title = "Añadir - Gestión Alumnos";

            #  obtener los cursos  para generar dinámicamente lista cursos
            $this->view->cursos = $this->model->getCursos();

            # cargo la vista con el formulario nuevo alumno
            $this->view->render('alumno/new/index');
        }

        function create ($param = []) { //Recoge los datos del formulario para enviarlos a la bbdd.

            # Iniciar sesión
            session_start();
            #Seguridad, saneamos los datos del formulario.
            #Para evitar la inyección de código a la bbdd. Se le llama sanear.

            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS); //??=Expresión abreviada que hace: ¿existe $_POST.., si existe, filtralo. Si no existe, ponlo a null. *operador de función de asignación de null.  
            $apellidos = filter_var($_POST['apellidos'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS); 
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL); 
            $telefono = filter_var($_POST['telefono'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS); 
            $poblacion = filter_var($_POST['poblacion'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $dni = filter_var($_POST['dni'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $fechaNac = filter_var($_POST['fechaNac'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS); 
            $id_curso = filter_var($_POST['id_curso'] ??= '', FILTER_SANITIZE_NUMBER_INT);   

            # 2. Creamos el alumno con los datos saneados.
            # Cargamos los datos del formulario
            $alumno = new classAlumno(
                null,
                $nombre,
                $apellidos,
                $email,
                $telefono,
                null,
                $poblacion,
                null,
                null, 
                $dni,      
                $fechaNac,
                $id_curso
            );

            # Validación

            $errores = [];

            // Nombre: obligatorio.
            if(empty($nombre)){ //Solo se puede usar si hemos usado ??= '' porque si no se completa el nombre, no tendría datos. ASí tiene datos vacíos.
                $errores['nombre'] = 'El campo nombre es obligatorio';
            }
            // Apellidos: obligatorio
            if(empty($apellidos)){ 
                $errores['apellidos'] = 'El campo apellidos es obligatorio';
            }
            // Email: obligatorio, formato válido y clave secundaria. Valor único.
            if(empty($email)){ 
                $errores['email'] = 'El campo email es obligatorio';
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Formato email no es válido.';
            }else if(!$this->model->validateUniqueEmail($email)){
                $errores['email'] = 'Ese email ya existe';
            }

            // DNI: obligatorio, debe contener 9 caracteres.
            $options = [ 'options' => ['regexp' => '/^(\d{8}([A-Z][a-z])$/']];

            if(empty($dni)){
                $errores['dni'] = 'El DNI no puede quedar vacío';
            }else if(!filter_var($dni, FILTER_VALIDATE_REGEXP, $options)){
                $errores['dni'] = 'Formato DNI incorrecto.';
            }else if(!$this->model->validateUniqueDni($dni)){
                $errores['dni'] = 'El DNI ya existe.';
            }

            // Fecha Nacimiento: Obligatorio y valor fecha válido
            $valores = explode('/', $fechaNac);
            if(empty($fechaNac)){
                $errores['fechaNac'] = 'Campo obligatorio';
            }else if(!checkdate($valores[1], $valores[0], $valores[2])){
                $errores['fechaNac'] = 'Fecha no válida';
            }

            // Id curso: obligatorio, entero, exitir en la bbdd.

            if(empty($id_curso)){
                $errores['id_curso'] = 'Debe selecccionar un curso';
            }else if(!filter_var($id_curso, FILTER_VALIDATE_INT)){
                $errores['id_curso'] = 'Curso no válido';
            }else if(!$this->model->validarCurso($id_curso)){
                $errores['id_curso'] = 'El curso no existe';
            }

            # Comprobar validación

            if(!empty($errores)){
                 # errores de validación
                 $_SESSION['alumno'] = serialize($alumno); //Convierte el obj alumno en un string.

            }else{
                // crear alumno
                # Añadir registro a la tabla
                $this->model->create($alumno);
                # Mensaje
                $_SESSION['mensaje'] = 'Alumno creado correctamente.';
                # Redirigimos al main de alumnos
                header('location:'.URL.'alumno');  
            }


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

            # Cargo id del alumno
            $id = $param[0];

            # Con los detalles formulario creo objeto alumno
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

            # Actualizo base  de datos
            $this->model->update($alumno, $id);

            # Cargo el controlador principal de alumno
            header('location:'. URL.'alumno');

        }

        public function order($param = []) {

            # Obtengo criterio de ordenación
            $criterio = $param[0];

            # Creo la propiedad title de la vista
            $this->view->title = "Ordenar - Panel Control Alumnos";
            
            # Creo la propiedad alumnos dentro de la vista
            # Del modelo asignado al controlador ejecuto el método get();
            $this->view->alumnos = $this->model->order($criterio);

            # Cargo la vista principal de alumno
            $this->view->render('alumno/main/index');
        }

        public function filter($param = []) {

            # Obtengo expresión de búsqueda
            $expresion = $_GET['expresion'];

            # Creo la propiedad title de la vista
            $this->view->title = "Buscar - Panel Control Alumnos";
            
            # Filtro a partir de la  expresión
            $this->view->alumnos = $this->model->filter($expresion);

            # Cargo la vista principal de alumno
            $this->view->render('alumno/main/index');
        }
    }

?>