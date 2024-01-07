<?php
    /**
     * clienteModel.php
     * Modelo del controlador cliente
     */

     class clienteModel extends Model{
        /**
         * Método get()
         * Extraemos los datos de todos los clientes
         */
        public function get(){
            try {
                // Creamos la sentencia necesaria para mostrar correctamente los datos
            // de los clientes
            $sql = "SELECT * FROM gesbank.clientes";

            // Conectamos con la base de datos
            $conexion = $this->db->connect();

            // Preparamos la consulta
            $pdostmt = $conexion->prepare($sql);

            // Establecemos el tipo de Fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            // Ejecutamos la consulta
            $pdostmt->execute();

            // Devolvemos el objeto de tipo PDOStatement
            return $pdostmt;
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método create(classCliente $cliente)
         * Insertamos un nuevo cliente en la base de datos
         */
        public function create(classCliente $cliente){
            try {
                // Creamos la consulta a ejecutar
                $sql = "INSERT INTO gesbank.clientes 
                VALUES (
                    null,
                    :apellidos,
                    :nombre,
                    :telefono,
                    :ciudad,
                    :dni,
                    :email,
                    now(),
                    now()
                )";
                // Preparamos la consulta
                $conexion = $this->db->connect();
                $pdostmt = $conexion->prepare($sql);

                // Vinculamos las variables
                $pdostmt->bindParam(':apellidos',$cliente->apellidos,PDO::PARAM_INT,10);
                $pdostmt->bindParam(':nombre',$cliente->nombre,PDO::PARAM_STR,45);
                $pdostmt->bindParam(':telefono',$cliente->telefono,PDO::PARAM_STR,9);
                $pdostmt->bindParam(':ciudad',$cliente->ciudad,PDO::PARAM_STR,20);
                $pdostmt->bindParam(':dni',$cliente->dni,PDO::PARAM_STR,9);
                $pdostmt->bindParam(':email',$cliente->email,PDO::PARAM_STR,45);

                // Ejecutamos la sentencia
                $pdostmt->execute();
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método read(int $id)
         * Devuelve el registro de una base de datos a través de un id
         */
        public function read(int $id){
            try {
                // Creamos la consulta a realizar
                $sql = "SELECT * FROM gesbank.clientes WHERE id=:id";

                // Creamos la conexión a la base de datos
                $conexion = $this->db->connect();

                // Preparamos la consulta
                $pdostmt = $conexion->prepare($sql);

                // Vinculamos la variable
                $pdostmt->bindParam(":id",$id,PDO::PARAM_INT);

                // Establecemos el tipo de fetch a usar
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                // Ejecutamos la consulta
                $pdostmt->execute();

                // Devolvemos un objeto de la clase PDOStatement
                return $pdostmt->fetch();
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método update(int $id, classCliente $cliente)
         * Actualiza un registro de la base de datos según su id
         */
        public function update(int $id, classCliente $cliente){
            try {
                // Creamos la consulta a ejecutar
                $sql= "UPDATE gesbank.clientes SET
                apellidos = :apellidos,
                nombre = :nombre,
                telefono = :telefono,
                ciudad = :ciudad,
                dni = :dni,
                update_at = now()
                WHERE id = :id
                ";

                // Creamos la conexion
                $conexion = $this->db->connect();

                // Preparamos la consulta
                $pdostmt = $conexion->prepare($sql);

                // Vinculamos las variables
                $pdostmt->bindParam(':id',$id,PDO::PARAM_INT);
                $pdostmt->bindParam(':apellidos',$cliente->apellidos,PDO::PARAM_STR,45);
                $pdostmt->bindParam(':nombre',$cliente->nombre, PDO::PARAM_STR,20);
                $pdostmt->bindParam(':telefono',$cliente->telefono, PDO::PARAM_STR,9);
                $pdostmt->bindParam(':ciudad',$cliente->ciudad,PDO::PARAM_STR,20);
                $pdostmt->bindParam(':dni',$cliente->dni,PDO::PARAM_STR,9);
                
                // Ejecutamos la sentencia
                $pdostmt->execute();
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método delete
         * Elimina un registro de la base de datos
         */
        public function delete(int $id){
            try {
                // Creamos la sentencia correspondiente
                $sql = "DELETE FROM gesbank.clientes WHERE clientes.id=:id";

                // Creamos la conexion
                $conexion = $this->db->connect();

                // Preparamos la consulta
                $pdostmt = $conexion->prepare($sql);

                // Vinculamos las variables
                $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);

                // Ejecutamos la sentencia
                $pdostmt->execute();
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método order
         * Devuelve un conjunto de registros ordenados según un criterio
         */
        public function order(int $criterio){
            try {
                // Creamos la consulta
                $sql ="SELECT 
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni FROM gesbank.clientes ORDER BY :criterio";

                // Creamos la conexion
                $conexion = $this->db->connect();

                // Preparamos la consulta
                $pdostmt = $conexion->prepare($sql);
                // Vincular los parametros a la consulta
                $pdostmt->bindParam(":criterio", $criterio,PDO::PARAM_INT);

                // Establecemos el tipo de fetch
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                // Ejecutamos la consulta
                $pdostmt->execute();

                // Devolvemos el resultado, siendo este un objeto tipo PDOStatement
                return $pdostmt;
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

        /**
         * Método filter
         * Devolver un cojunto de registros, que coincidan con una expresión
         */
        public function filter($expresion){
            try {
                // Creamos la consulta
                $sql ="SELECT 
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni FROM gesbank.clientes
                WHERE CONCAT_WS(' ',
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni) LIKE :expresion";

                // Conectarnos a la base de datos
                $conexion = $this->db->connect();

                // Preparamos la consulta
                $pdostmt = $conexion->prepare($sql);

                // Vincular las variables, aunque previamente modificaremos la expresion
                $expresion = '%'.$expresion.'%';
                $pdostmt -> bindParam(":expresion",$expresion);

                // Establecemos el tipo de fetch a usar
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                // Ejecutamos la consulta
                $pdostmt->execute();

                // Devolvemos un objeto de tipo PDOStatement
                return $pdostmt;

            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }
     }
?>