<?php

Class Corredores extends Conexion {


    public function get_corredores(){

        try{

            $sql= "SELECT 
                    corredores.id,
                    corredores.nombre,
                    corredores.apellidos,
                    corredores.ciudad,
                    corredores.email,
                    corredores.edad,
                    categorias.nombreCorto as id_categoria,
                    clubs.nombreCorto as id_club
                    FROM
                     corredores
                     INNER JOIN categorias ON corredores.id_categoria = categorias.id
                     INNER JOIN clubs ON corredores.id_club = clubs.id
                     ORDER BY id";
                     
            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;


        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function get_categorias(){
        try{

            $sql = "SELECT 
                        id,
                        nombreCorto,
                        nombre,
                        descripcion
                        FROM
                        categorias";

            $pdostmt = $this->pdo->prepare($sql);

            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;
        }catch (PDOException $e){
            include('views/partials.errorDB.php');
            exit();
        }
    }

    public function get_clubs (){
        try{

            $sql = "SELECT 
                        id,
                        nombreCorto,
                        nombre,
                        ciudad,
                        fecFundacion,
                        numSocios";

            $pdostmt = $this->pdo->prepare($sql);
            
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;


        }catch(PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    
}


?>