    <?php

    require 'models/perfilModel.php';

    class usuarioModel extends Model {

        public function get(){
            try {
        
            $sql = "SELECT 
                        id,
                        name,
                        email,
                        password
                            FROM users";

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

        # Valida nombre de usuario ha de ser único
        public function validateName($name) {

            try {
                $sql = "
                        SELECT * FROM users
                        WHERE name = :name
                ";

                # Conectamos con la base de datos
                $conexion = $this->db->connect();
        
                # Ejecutamos mediante prepare la consulta SQL
                $result= $conexion->prepare($sql);
                $result->bindParam(':name', $name, PDO::PARAM_STR);
                $result -> execute();

            if ($result->rowCount() == 0) 
                        return TRUE;
                return FALSE;

            } catch(PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }
            
        
        }

        # Creo nuevo usuario a partir de los datos de formulario de registro
        public function create ($name, $email, $pass) {
            try {
                //pasword_hash, crea una cadena de 60 caracteres. Lo encripta con el algortimo CRYPT_BLOWFISH.
                $password_encriptado = password_hash($pass, CRYPT_BLOWFISH); 
            
                $insertarsql = "INSERT INTO users VALUES (
                    null,
                    :nombre,
                    :email,
                    :pass,
                    default,
                    default)";

                $pdo = $this->db->connect();
                $stmt = $pdo->prepare($insertarsql);

                $stmt->bindParam(':nombre', $name, PDO::PARAM_STR, 50);
                $stmt->bindParam(':email', $email , PDO::PARAM_STR, 50);
                $stmt->bindParam(':pass', $password_encriptado, PDO::PARAM_STR, 60) ;


                
                $stmt->execute();

                # Asignamos rol de registrado
                // Rol que asignaremos por defecto. El 3 es el perfil de registrado.
                $role_id = 3;
                $insertarsql = "INSERT INTO roles_users VALUES (
                    null,
                    :user_id,
                    :role_id,
                    default,
                    default)";
                
                # Obtener id del último usuario insertado
                $ultimo_id = $pdo->lastInsertId();

                $stmt = $pdo->prepare($insertarsql);

                $stmt->bindParam(':user_id', $ultimo_id);
                $stmt->bindParam(':role_id', $role_id);
                $stmt->execute();

            }  catch (PDOException $e) {
                
                include_once('template/partials/errorDB.php');
                exit();

            }
        }

    # Valida nombre de usuario ha de ser único
    public function validateEmail($email) {

        try {
            $sql = "
                    SELECT * FROM users
                    WHERE email = :email
            ";

            # Conectamos con la base de datos
            $conexion = $this->db->connect();

            # Ejecutamos mediante prepare la consulta SQL
            $result= $conexion->prepare($sql);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result -> execute();

            if ($result->rowCount() == 0) 
                return TRUE;
            return FALSE;

        } catch(PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }
        
        }

       
        public function read($id){
            try {
                  $sql= " SELECT * FROM users WHERE id = :id";
                
                $conexion = $this->db->connect();
                $pdostmt = $conexion->prepare($sql);
                $pdostmt->bindParam(":id",$id,PDO::PARAM_INT);
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);
                $pdostmt->execute();
    
                return $pdostmt->fetch();
    
            } catch (PDOException $e) {
                include 'template/partials/error.php';
                exit();
            }
        }
    

        
     function update($id, $usuario){
        try {
            
            $sql= "UPDATE users SET
                   name = :name,
                   email = :email
                  
                    WHERE id = :id
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);
           
            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdostmt->bindParam(":name", $usuario->name, PDO::PARAM_STR, 20);
            $pdostmt->bindParam(":email", $usuario->email, PDO::PARAM_INT);
           
           
            $pdostmt->execute();

        } catch (PDOException $e) {
            include 'template/partials/error.php';
            
            exit();
        }
    }

    public function delete(int $id){
        try {
           
            $sql = "DELETE FROM users WHERE id=:id";

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
           
            $sql ="SELECT * FROM users ORDER BY :criterio";
            
           
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
            users.id,
            users.name,
            users.email
             FROM users
            WHERE CONCAT_WS(' ,',
            users.id,
            users.name, 
            users.email) LIKE :expresion
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

}   

   
    
?>