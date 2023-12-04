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
    }

?>