<?php 
    class RegisterModel extends Model {

    # Valida el nombre de usuario teniendo en cuenta la longitud del campo.
    public function validateName($username) {
        if ((strlen($username) < 5) || (strlen($username) > 50)) {
            return false;
        }
        return true;
    
    }

    #Validar password teniendo en cuenta la longitud del campo.
    public function validatePass($pass) {
        if ((strlen($pass) < 5) || (strlen($pass) > 50)) {
            return false;
        }
        return true;
    }

    #Validar email que el email sea único.
    public function validateEmailUnique($email) {

        try {
        
            $selectSQL = "SELECT * FROM users WHERE email = :email";
            $pdo = $this->db->connect();
            $pdoSt = $pdo->prepare($selectSQL);
            $pdoSt->bindParam(':email', $email, PDO::PARAM_STR, 50);
            $pdoSt->execute();
            if ($pdoSt->rowCount() > 0)
                return false;
            else 
                return true; // Devuelve true cuando el email no existe. O sea que el email es correcto.
        } catch (PDOException $e) {
            
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





    }
?>