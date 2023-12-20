<?php

    /* 
         alumnosModel.php

         Modelo del controlador alumnos
         Definir los métodos de acceso a la base de datos

         -insert
         -update
         -select
         -delete
         -etc.
    */

    class alumnoModel extends Model{

        /*  Extrae los detalles de los alumnos*/

        public function get(){

        try{

            #comando sql
            $sql= "SELECT 
                    alumnos.id,
                    concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
                    alumnos.email,
                    alumnos.telefono,
                    alumnos.poblacion,
                    alumnos.dni,
                    timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
                    cursos.nombreCorto curso
                FROM
                    alumnos
                INNER JOIN
                    cursos
                ON alumnos.id_curso = cursos.id
                ORDER BY id";

            #conectamos con la base de datos. $this->db es un objeto del a clase 'database'
            //Ejecuta el método connect de esa clase
            $conexion = $this->db->connect();

            //ejecutamos mediante prepare
            $pdostmt = $conexion->prepare($sql);


            //establecemos el tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            //ejecutamos
            $pdostmt->execute();

            //devuelvo objeto pdostmt
            return $pdostmt;

        }catch(PDOException $e){
            include_once('template/partials/error.php');

        }

    }

    public function getCursos(){

        try{
            $sql = "SELECT 
                    id,
                    nombreCorto curso
                    FROM
                    cursos
                    ORDER BY 
                    nombreCorto";

             //Ejecuta el método connect de esa clase
             $conexion = $this->db->connect();

             //ejecutamos mediante prepare
             $pdostmt = $conexion->prepare($sql);
 
 
             //establecemos el tipo de fetch
             $pdostmt->setFetchMode(PDO::FETCH_OBJ);
 
             //ejecutamos
             $pdostmt->execute();
 
             //devuelvo objeto pdostmt
             return $pdostmt;
            
        }catch(PDOException $e){
            include_once('template/partials/error.php');

        }
    }

    public function create(classAlumno $alumno){

        try{
            $sql = 'INSERT INTO alumnos(
                nombre,
                apellidos,
                email,
                telefono,
                poblacion,
                dni,
                fechaNac,
                id_curso
                )VALUES(
                :nombre,
                :apellidos,
                :email,
                :telefono,
                :poblacion,
                :dni,
                :fechaNac,
                :id_curso)';

        $conexion = $this->db->connect();

        $pdostmt = $conexion->prepare($sql);

        $pdostmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
        $pdostmt->bindParam(':apellidos', $alumno->aoellidos, PDO::PARAM_STR, 30);
        $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 30);
        $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 13);
        $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
        $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 30);
        $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
        $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT, 30);

        $pdostmt->execute();

        $pdostmt = null;

        $this->prepare = null;


        }catch(PDOException $e){
        include_once('template/partials/error.php');

        }

    }

    public function read($id){

        try{
            'SELECT * FROM alumnos WHERE alumnos.id = :id';

            $pdostmt = $this->pdo->prepare($sql);
           
        }
    }
}
?>