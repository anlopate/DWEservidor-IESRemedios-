<?php

    /* 
         alumnosModel.php

         Modelo del controlador alumnos
         Definir los métodos de acceso a la base de datos

         -insert
         -update
         -select
         -delete
         -etc.
    */

    class alumnoModel extends Model{

        /*  Extrae los detalles de los alumnos*/

        public function get(){

        try{

            #comando sql
            $sql= "SELECT * FROM alumnos";

            #conectamos con la base de datos. $this->db es un objeto del a clase 'database'
            //Ejecuta el método connect de esa clase
            $conexion = $this->db->connect();

            //ejecutamos mediante prepare
            $pdostmt = $conexion->prepare($sql);


            //establecemos el tipo de fetch
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            //ejecutamos
            $pdostmt->execute();

            //devuelvo objeto pdostmt
            return $pdostmt;

        }catch(PDOException $e){
            include_once('template/partials/error.php');

        }

    }
}
?>