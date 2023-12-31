<?php


Class Corredores extends Conexion{

    public function get_Corredores(){

        try{

            $sql = "SELECT 
                corredores.id,
                corredores.nombre,
                corredores.apellidos,
                corredores.ciudad,
                corredores.email,
                timestampdiff(YEAR,  corredores.fechaNacimiento, NOW()) as edad,
                corredores.id_categoria,
                corredores.id_club
                FROM corredores
                ORDER BY corredores.id";
            
            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);
            
            $pdostmt->execute();

            return $pdostmt;
        
        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function get_Categorias(){

        try{

            $sql = "SELECT 
                        id,
                        nombreCorto,
                        nombre,
                        descripcion
                        FROM
                        categorias
                        ";

            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);


            $pdostmt->execute();

            return $pdostmt;

        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function get_Clubs (){

        try{
            $sql = 'SELECT
                        id,
                        nombreCorto,
                        nombre,
                        ciudad,
                        fecFundacion, 
                        numSocios
                        FROM 
                        clubs';

            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;
            
        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function insert_Corredor (Corredor $corredor){

        try{

            $sql = "INSERT INTO corredores VALUES (
                    null,
                    :nombre,
                    :apellidos,
                    :ciudad,
                    :fechaNacimiento,
                    :sexo,
                    :email,
                    :dni,
                    null,
                    :id_categoria,
                    :id_club)";

              $pdostmt = $this->pdo->prepare($sql);
              
              $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 50);
              $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
              $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 100);
              $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
              $pdostmt->bindParam(':sexo', $corredor->sexo, PDO::PARAM_STR ,1);
              $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 20);
              $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 9);
              $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_STR,5);
              $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT, 1);

              $pdostmt->execute();

              $pdostmt = null;

              $this->pdo = null;

            }catch(PDOException $e){
                include('views/partials/errorDB.php');
                exit();
            }

    }
}
?>