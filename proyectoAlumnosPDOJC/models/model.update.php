<?php
    /*
        Modelo: model.update.php
        Descripción: actualiza los detalle de un alumno

        Método POST 
            - nombre
            - apellidos
            - email
            - telefono
            - direccion
            - poblacion
            - provincia
            - nacionalidad
            - dni
            - fechaNac
            - id_curso
        
        Método GET
            - id 
    */

    // Capturamos el id enviado a través del método GET
    $id_actualizar = $_GET['id'];

    // Recogemos los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $email = $_POST['mail'];
    $telefono = $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $poblacion = $_POST['poblacion'];
    $provincia = $_POST['provincia'];
    $nacionalidad = $_POST['nacionalidad'];
    $dni = $_POST['dni'];
    $fechaNac = $_POST['fechaNac'];
    $curso = $_POST['id_curso'];

    // Creamos un objeto de la clase alumno
    $alumno = new Alumno();

    $alumno->nombre=$nombre;
    $alumno->apellidos=$apellidos;
    $alumno->email=$email;
    $alumno->telefono=$telefono;
    $alumno->direccion=$direccion;
    $alumno->poblacion=$poblacion;
    $alumno->provincia=$provincia;
    $alumno->nacionalidad=$nacionalidad;
    $alumno->dni=$dni;
    $alumno->fechaNac=$fechaNac;
    $alumno->id_curso=$curso;

    // Creamos la conexión a la base de datos
    $conexion= new Alumnos();

    // Añadimo el nuevo registro
    $conexion->update_alumno($alumno,$id_actualizar);

    // Generamos una notificación
    $notificacion = "Alumno actualizado con éxito";

?>