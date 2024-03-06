<?php
   
     class clienteModel extends Model{
       
        public function get(){
            try {
         
            $sql = "SELECT 
                        id,
                        concat_ws(',', apellidos, nombre) as cliente,
                        telefono,
                        ciudad,
                        dni,
                        email
             FROM clientes";

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
                print "Error: " . $e->getMessage();
                include 'template/partials/error.php';
                exit();
            }
        }

       
        public function read($id){
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

       
        public function update(classCliente $cliente, $id){
                try {
                    $sql = "  UPDATE clientes
                            SET
                                apellidos=:apellidos,
                                nombre=:nombre,
                                telefono=:telefono,
                                ciudad=:ciudad,
                                dni=:dni,
                                email=:email,
                                update_at = now()
                            WHERE
                                id=:id
                            LIMIT 1";
                           
        
                    $conexion = $this->db->connect();
                    $pdoSt = $conexion->prepare($sql);
                    //Vinculamos los parámetros
                    $pdoSt->bindParam(":nombre", $cliente->nombre, PDO::PARAM_STR, 30);
                    $pdoSt->bindParam(":apellidos", $cliente->apellidos, PDO::PARAM_STR, 50);
                    $pdoSt->bindParam(":email", $cliente->email, PDO::PARAM_STR, 50);
                    $pdoSt->bindParam(":telefono", $cliente->telefono, PDO::PARAM_STR, 9);
                    $pdoSt->bindParam(":ciudad", $cliente->ciudad, PDO::PARAM_STR, 30);
                    $pdoSt->bindParam(":dni", $cliente->dni, PDO::PARAM_STR, 9);
                    $pdoSt->bindParam(":id", $id, PDO::PARAM_INT);
        
                    $pdoSt->execute();
                } catch (PDOException $error) {
                    require_once("template/partials/errorDB.php");
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
                concat_ws(',', clientes.apellidos, clientes.nombre) cliente,
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
                include 'template/partials/errorDB.php';
                exit();
            }
        }

      
        public function filter($expresion){
            try {
               
                $sql ="SELECT 
                clientes.id,
                concat_ws(',', clientes.apellidos, clientes.nombre) cliente,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni FROM clientes
                WHERE CONCAT_WS(' ,',
                clientes.id,
                clientes.apellidos, 
                clientes.nombre,
                clientes.email,
                clientes.telefono,
                clientes.ciudad,
                clientes.dni) LIKE :expresion
                ORDER BY id ASC";

               
                $conexion = $this->db->connect();

                $pdostmt = $conexion->prepare($sql);

                $expresion = '%'.$expresion.'%';
                $pdostmt -> bindParam(":expresion",$expresion, PDO::PARAM_STR);

                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt;

            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }

        public function validateUniqueEmail ($email){
            try{
                    $sql = "SELECT * FROM clientes WHERE email = :email ";
    
                    $conexion = $this->db->connect();
                    $pdost = $conexion->prepare($sql);
    
                    $pdost->bindParam(':email', $email, PDO::PARAM_STR);
                    $pdost->execute();
    
                    if($pdost->rowCount() != 0){
                        return false;
                    }
                    return true; //Devuelve true, quiere decir que está validado.
    
            }catch (PDOException $e){
                    include_once('template/partials/errorDB.php');
                    exit();
                    
                }
    
         }

         
     public function validateUniqueDni ($dni){
        try{
                $sql = "SELECT * FROM clientes WHERE dni = :dni ";

                $conexion = $this->db->connect();
                $pdost = $conexion->prepare($sql);

                $pdost->bindParam(':dni', $dni, PDO::PARAM_STR);
                $pdost->execute();

                if($pdost->rowCount() != 0){
                    return false;
                }
                return true; //Devuelve true, quiere decir que está validado.

        }catch (PDOException $e){
                include_once('template/partials/errorDB.php');
                exit();
                
            }

     }


     }
?>