<?php
   
     class clienteModel extends Model{
       
        public function get(){
            try {
         
            $sql = "SELECT * FROM clientes";

            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

           
            $pdostmt->execute();

            return $pdostmt;
            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }

        public function create(classCliente $cliente){
            try {
               
                $sql = "INSERT INTO clientes 
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
               
                $conexion = $this->db->connect();
                $pdostmt = $conexion->prepare($sql);

              
                $pdostmt->bindParam(':apellidos',$cliente->apellidos,PDO::PARAM_INT,10);
                $pdostmt->bindParam(':nombre',$cliente->nombre,PDO::PARAM_STR,45);
                $pdostmt->bindParam(':telefono',$cliente->telefono,PDO::PARAM_STR,9);
                $pdostmt->bindParam(':ciudad',$cliente->ciudad,PDO::PARAM_STR,20);
                $pdostmt->bindParam(':dni',$cliente->dni,PDO::PARAM_STR,9);
                $pdostmt->bindParam(':email',$cliente->email,PDO::PARAM_STR,45);

                $pdostmt->execute();

            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }

       
        public function read(int $id){
            try {
                
                $sql = "SELECT * FROM clientes WHERE id=:id";

              
                $conexion = $this->db->connect();

                $pdostmt = $conexion->prepare($sql);

                $pdostmt->bindParam(":id",$id,PDO::PARAM_INT);

                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt->fetch();

            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

       
        public function update(int $id, classCliente $cliente){
            try {
                
                $sql= "UPDATE clientes SET
                        apellidos = :apellidos,
                        nombre    = :nombre,
                        telefono  = :telefono,
                        ciudad    = :ciudad,
                        dni       = :dni,
                        update_at = now()
                WHERE id = :id
                ";

               
                $conexion = $this->db->connect();

                $pdostmt = $conexion->prepare($sql);

               
                $pdostmt->bindParam(':id',$id,PDO::PARAM_INT);
                $pdostmt->bindParam(':apellidos',$cliente->apellidos,PDO::PARAM_STR,45);
                $pdostmt->bindParam(':nombre',$cliente->nombre, PDO::PARAM_STR,20);
                $pdostmt->bindParam(':telefono',$cliente->telefono, PDO::PARAM_STR,9);
                $pdostmt->bindParam(':ciudad',$cliente->ciudad,PDO::PARAM_STR,20);
                $pdostmt->bindParam(':dni',$cliente->dni,PDO::PARAM_STR,9);
                
               
                $pdostmt->execute();
            } catch (PDOException $e) {
                include 'template/partials/errorDB.php';
                exit();
            }
        }

       
        public function delete(int $id){
            try {
               
                $sql = "DELETE FROM clientes WHERE clientes.id=:id";

                $conexion = $this->db->connect();

               
                $pdostmt = $conexion->prepare($sql);

               
                $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);

               
                $pdostmt->execute();
            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }

        public function order(int $criterio){
            try {
               
                $sql ="SELECT 
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni FROM clientes ORDER BY :criterio";

               
                $conexion = $this->db->connect();

               
                $pdostmt = $conexion->prepare($sql);
               
                $pdostmt->bindParam(":criterio", $criterio,PDO::PARAM_INT);

                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();
               
                return $pdostmt;

            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }

      
        public function filter($expresion){
            try {
               
                $sql ="SELECT 
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni FROM clientes
                WHERE CONCAT_WS(' ',
                clientes.id,
                clientes.nombre,
                clientes.apellidos,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni) LIKE :expresion";

               
                $conexion = $this->db->connect();

                
                $pdostmt = $conexion->prepare($sql);

              
                $expresion = '%'.$expresion.'%';
                $pdostmt -> bindParam(":expresion",$expresion);

               
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

               
                $pdostmt->execute();

               
                return $pdostmt;

            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }
     }
?>