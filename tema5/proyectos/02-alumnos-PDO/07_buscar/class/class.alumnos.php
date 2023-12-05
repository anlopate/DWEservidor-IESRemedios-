<?php

    /*
        Clase Fp

        Métodos específicos para BBDD  fp con las tablas
        - Alumnos
        - Cursos
    */



    Class Alumnos extends Conexion {


        public function getAlumnos(){

                $sql = "SELECT 
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

            #Prepare-> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            #Establezco conexión tipo de fetch me devuelve cada alumno con un objeto. Si quisiera que los devolviera como una array asociativo uso PDO::FETCH_ASOC. Hay que cambiar en view.indexphp
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            #Ejecuto
            $pdostmt->execute();

            #Devuelvo objeto clase pdostatment
            return $pdostmt;
        }


        public function getCursos(){

            $sql = "select 
                    id, nombreCorto curso
                    FROM
                    cursos
                    ORDER BY
                    id";

        #Prepare-> objeto clase pdostatement
        $pdostmt = $this->pdo->prepare($sql);

        #Establezco conexión tipo de fetch me devuelve cada alumno con un objeto. Si quisiera que los devolviera como una array asociativo uso PDO::FETCH_ASOC. Hay que cambiar en view.indexphp
        $pdostmt->setFetchMode(PDO::FETCH_OBJ);

        #Ejecuto
        $pdostmt->execute();

        #Devuelvo objeto clase pdostatment
        return $pdostmt;
    }
        
        public function insert_curso(Curso $curso){

            try {

                # Prepare o plantilla sql
                $sql = "
                    INSERT INTO Cursos (
                        nombre,
                        ciclo,
                        nombreCorto,
                        nivel
                    ) VALUES (
                        :nombre,
                        :ciclo,
                        :nombreCorto,
                        :nivel
                    )
                
                ";

                # objeto de clase PDOStatement
                $pdostmt = $this->pdo->prepare($sql);

                # Vincular los parámetros con valores
                $pdostmt->bindParam(':nombre', $curso->nombre, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':ciclo', $curso->ciclo, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':nombreCorto', $curso->nombreCorto, PDO::PARAM_STR, 4);
                $pdostmt->bindParam(':nivel', $curso->nivel, PDO::PARAM_INT, 1);

                #ejecutamos sql
                $pdostmt->execute();

                # liberamos objeto 
                $pdostmt = null;

                # cerramos conexión
                $this->$pdo = null;
            }
            catch (PDOException $e) {

                include('views/partials/errorDB.php');
                exit();

            }
        }

        public function insert_alumno(Alumno $alumno){

            try {

                # Prepare o plantilla sql
                $sql = "
                    INSERT INTO alumnos VALUES (
                       null,
                       :nombre,
                       :apellidos,
                       :email,
                       :telefono,
                       :direccion,
                       :poblacion,
                       :provincia,
                       :nacionalidad,
                       :dni,
                       :fechaNac,
                       :id_curso
                    )";
                
                

                # objeto de clase PDOStatement
                $pdostmt = $this->pdo->prepare($sql);

                # Vincular los parámetros con valores
                $pdostmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
                $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 10);
                $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 1);
                $pdostmt->bindParam(':direccion', $alumno->direccion, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':provincia', $alumno->provincia, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 10);
                $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
                $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

                #ejecutamos sql
                $pdostmt->execute();

                # liberamos objeto 
                $pdostmt = null;

                # cerramos conexión
                $this->$pdo = null;
            }
            catch (PDOException $e) {

                include('views/partials/errorDB.php');
                exit();

            }
        }

        public function readAlumno($id_alumno){

            try{ #Prepare o plantilla SQL

                $sql ="SELECT * FROM fp.alumnos WHERE alumnos.id = :id";
                //mediante prepare
                $pdostmt = $this->pdo->prepare($sql);
                //vinculamos paramentros
                $pdostmt->bindParam(':id', $id_alumno, PDO::PARAM_INT);

                #Establezco conexión tipo de fetch me devuelve el alumno como un objeto. 
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);
    
                #Ejecuto
                $pdostmt->execute();
    
                #Devuelvo objeto clase Alumno.
                return $pdostmt->fetch();//extraemos los elementos que ha devuelto el objeto pdostmt
               
            }catch (PDOException $e) {

                include('views/partials/errorDB.php');
                exit();

            }

        }
              

        public function update_alumno(Alumno $alumno, $id_alumno) {

            try{
                #Prepare o plantilla SQL

                $sql = "UPDATE alumnos SET 
                    nombre= :nombre, 
                    apellidos= :apellidos, 
                    email= :email, 
                    telefono= :telefono, 
                    direccion= :direccion, 
                    poblacion= :poblacion, 
                    provincia= :provincia, 
                    nacionalidad= :nacionalidad, 
                    dni= :dni, 
                    fechaNac= :fechaNac,
                    id_curso= :id_curso
                WHERE id= :id";

                 #Prepare-> objeto clase pdostatement
                $pdostmt = $this->pdo->prepare($sql);

                
                $pdostmt->bindParam(':nombre', $alumno->nombre);
                $pdostmt->bindParam(':apellidos', $alumno->apellidos);
                $pdostmt->bindParam(':email', $alumno->email);
                $pdostmt->bindParam(':telefono', $alumno->telefono);
                $pdostmt->bindParam(':direccion', $alumno->direccion);
                $pdostmt->bindParam(':poblacion', $alumno->poblacion);
                $pdostmt->bindParam(':provincia', $alumno->provincia);
                $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad);
                $pdostmt->bindParam(':dni', $alumno->dni);
                $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
                $pdostmt->bindParam(':id_curso', $alumno->id_curso);
                $pdostmt->bindParam(':id', $id_alumno);

                 #ejecutamos sql
                 $pdostmt->execute();

                 # liberamos objeto 
                 $pdostmt = null;
 
                 # cerramos conexión
                 $this->$pdo = null;

                

            }catch (PDOException $e) {
                include('views/partials/errorDB.php');
                exit();
        }
    }

    public function delete_alumno ($id){

        try{
            //Petición a bbdd
            $sql = "DELETE  FROM alumnos WHERE id = $id";

            //Prepare
            $pdostmt = $this->pdo->prepare($sql);
            //$pdostmt->bindParam(":id",$indice, PDO::PARAM_INT);

            //Ejecutar la petición sql
            $pdostmt->execute();

            //Liberar objeto
            $pdostmt = null;

            //Cerrar conexión
            $this->$pdo = null;

        }catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function ordenar ($criterio){

        try{
            $sql = "SELECT 
            alumnos.id,
            concat_ws(', ', alumnos.apellidos, alumnos.nombre) alumno,
            timestampdiff(YEAR,  alumnos.fechaNac, NOW() ) edad,
            alumnos.dni,
            alumnos.poblacion,
            alumnos.email,
            alumnos.telefono,
            cursos.nombreCorto curso 
            FROM
            alumnos
            INNER JOIN
                cursos ON alumnos.id_curso = cursos.id
                ORDER BY $criterio";
            //Ejecutar prepare 
            $pdostmt = $this->pdo->prepare($sql);

            //Esteblezco el tipo de dato que quiero obtener
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            //Ejecutar
            $pdostmt->execute();

            return $pdostmt;

        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }

    }

    public function filter($expresion){
    
        $sql = "SELECT 
                    alumnos.id,
                    CONCAT_WS(', ', alumnos.apellidos, alumnos.nombre) AS alumno,
                    alumnos.email,
                    alumnos.telefono,
                    alumnos.poblacion,
                    alumnos.dni,
                    TIMESTAMPDIFF(YEAR,
                        alumnos.fechaNac,
                        NOW()) AS edad,
                    cursos.nombreCorto AS curso
                    FROM
                    alumnos
                    INNER JOIN cursos ON alumnos.id_curso = cursos.id
                    WHERE CONCAT_WS(' ',
                    alumnos.id, 
                    alumnos.nombre,
                    alumnos.apellidos, 
                    alumnos.email, 
                    alumnos.telefono,
                    alumnos.poblacion, 
                    alumnos.dni, 
                    alumnos.fechaNac, 
                    cursos.nombreCorto
                    ) LIKE $expresion";

        # ejecutamos el prepare -> objeto de la clase pdostatament
        $pdostsmt = $this->pdo->prepare($sql);

        # Vinculamos la expreesión con bimParam
        $pdostsmt->bindParam(':expresion', "%$expresion%", PDO::PARAM_STR);

        # Establezco tipo de fetch
        $pdostsmt->setFetchMode(PDO::FETCH_OBJ); // extrae cada elemento como un objeto

        # Ejecuto
        $pdostsmt->execute();
        
       
        return $pdostsmt;

    }
}

?>