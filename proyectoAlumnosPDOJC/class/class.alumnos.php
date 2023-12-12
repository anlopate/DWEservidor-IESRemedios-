<?php

/*
    Clase Alumnos

    Métodos específicos para BBDD  fp con las tablas
    - Alumnos
    
*/

class Alumnos extends Conexion
{

    /*

        getAlumnos()

        Devuelve un objeto conjunto resultados (PDO_result) 
        con los detalles de  todos los alumnos
 

    */
    public function getAlumnos()
    {
        try {
            $sql = "

            SELECT 
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
            ORDER BY id
            
                ";

            # Prepare -> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            # Establezco tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecuto
            $pdostmt->execute();

            # Devuelvo objeto clase pdostatement
            return $pdostmt;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }

    /*

        getCursos()

        Obtengo los cursos de la tabla cursos de la bbdd fp
 

    */
    public function getCursos()
    {
        try {
            $sql = "

                    SELECT 
                        id, nombreCorto curso
                    FROM
                        cursos
                    ORDER BY id
        
            ";

            # Prepare -> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            # Establezco tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecuto
            $pdostmt->execute();

            # Devuelvo objeto clase pdostatement
            return $pdostmt;
        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }
    public function insert_curso(Curso $curso)
    {

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
            $this->pdo = null;
        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }
    }

    /*
        inserta Alumno en la tabla alumnos de la bbdd fp
    */
    public function insertAlumno(Alumno $alumno)
    {

        try {
            # Prepare
            $sql = "
                        INSERT INTO Alumnos VALUES
                        (
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
                        )
                        ";

            # Objeto clase mysqli_stmt
            $pdostmt = $this->pdo->prepare($sql);

            # Vinculo parámetros con variables
            $pdostmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':direccion', $alumno->direccion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':provincia', $alumno->provincia, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
            $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

            # Ejecuto mysqli_stmt e inserto registro
            $pdostmt->execute();

            # Libero memoria
            $pdostmt = null;

            # Cerrar conexión
            $this->pdo = null;
        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }
    }

    /*
        read_alumno($id)
        Devuelve un objeto conjunto resultados con los datos de un alumno.
        Se pásara el id como parametro
    */
    public function read_alumno($id)
    {
        try {
            $sql = "SELECT * FROM alumnos WHERE id = :id";

            // Mediante Prepare
            $pdostmt = $this->pdo->prepare($sql);

            // Vinculamos parametros
            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);

            // Elegimos el tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutamos
            $pdostmt->execute();

            // Devolvemos el registro
            return $pdostmt->fetch();

        } catch (PDOException $e) {
            include '../views/partials/errorDB.php';
            exit();
        }

    }

    /*
       updateAlumno(Alumno $alumno,$indice)
   */
    public function update_alumno(Alumno $alumno, $id)
    {
        try {

            // Consulta SQL
            $sql = "
                UPDATE alumnos SET 
                    nombre = :nombre, 
                    apellidos = :apellidos,
                    email = :email, 
                    telefono = :telefono, 
                    direccion = :direccion, 
                    poblacion = :poblacion, 
                    provincia = :provincia, 
                    nacionalidad = :nacionalidad, 
                    dni = :dni, 
                    fechaNac = :fechaNac,
                    id_curso = :id_curso
                WHERE 
                    id = :id
                LIMIT 1
            ";

            // Prepare-> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            // Vincular los parámetros
            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);
            $pdostmt->bindParam(':nombre', $alumno->nombre, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':apellidos', $alumno->apellidos, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':email', $alumno->email, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':telefono', $alumno->telefono, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':direccion', $alumno->direccion, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':poblacion', $alumno->poblacion, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':provincia', $alumno->provincia, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':nacionalidad', $alumno->nacionalidad, PDO::PARAM_STR, 30);
            $pdostmt->bindParam(':dni', $alumno->dni, PDO::PARAM_STR, 9);
            $pdostmt->bindParam(':fechaNac', $alumno->fechaNac);
            $pdostmt->bindParam(':id_curso', $alumno->id_curso, PDO::PARAM_INT);

            // Ejecutamos la sentencia preparada
            $pdostmt->execute();

            // Libero memoria
            $pdostmt = null;

            // Cerramos conexión
            $this->pdo = null;

        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

    /*
        get_curso($id)

        devuelve el nombre del curso asociado a su id
    */
    public function get_curso($id)
    {
        try {

            $sql = "

                SELECT 
                    id, 
                    nombreCorto curso
                FROM
                    cursos
                wHERE id = :id
                LIMIT 1

                ";

            # Prepare -> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            # Vinculo los parámetros
            $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);

            # Establezco tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecuto
            $pdostmt->execute();

            # Sólo tengo 1 resultado y de ese resultado me interesa curso
            return $pdostmt->fetch()->curso;

        } catch (PDOException $e) {
            include('views/partials/errorDB.php');
            exit();
        }
    }

    /*

        order($criterio)

        

        Devuelve un objeto pdostatement
        con los detalles de  todos los alumnos

        Tenemos que forzar que criterio sea valor entero, vamos a usar como criterio
        de ordenación el número de la columna desde 2 hasta 8, donde 2 es por alumno,
        y 8 es por curso.
 

    */
    public function order(int $criterio)
    {
        try {
            $sql = "

            SELECT 
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
            ORDER BY :order ASC
            
            ";

            # Prepare -> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            # Enlazamos parámetro con variable
            $pdostmt->bindParam(':order', $criterio, PDO::PARAM_INT);

            # Establezco tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecuto
            $pdostmt->execute();

            # Devuelvo objeto clase pdostatement
            return $pdostmt;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }

    /*

        filter($expresion)

        Devuelve un objeto clase pdostatement con los detalles
        filtrados de alumnos

        
 

    */
    public function filter($expresion)
    {
        try {
            $sql = "

            SELECT 
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
            WHERE CONCAT_WS(' ',
                            alumnos.id, 
                            alumnos.nombre,
                            alumnos.apellidos, 
                            alumnos.email, 
                            alumnos.telefono, 
                            alumnos.poblacion, 
                            alumnos.dni, 
                            TIMESTAMPDIFF(YEAR, alumnos.fechaNac, NOW()), 
                            cursos.nombreCorto) 
            LIKE :expresion
            ORDER BY alumnos.id ASC
            
            ";

            # Prepare -> objeto clase pdostatement
            $pdostmt = $this->pdo->prepare($sql);

            # Enlazamos parámetro con variable
            $expresion = '%'.$expresion.'%';
            $pdostmt->bindParam(':expresion', $expresion, PDO::PARAM_STR);

            # Establezco tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            # Ejecuto
            $pdostmt->execute();

            # Devuelvo objeto clase pdostatement
            return $pdostmt;

        } catch (PDOException $e) {

            include('views/partials/errorDB.php');
            exit();

        }

    }



}

?>