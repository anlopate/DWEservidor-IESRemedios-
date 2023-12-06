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
}
?>