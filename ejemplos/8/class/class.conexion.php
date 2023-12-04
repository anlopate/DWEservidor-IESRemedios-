<?php

    /* Clase Conexión. Para todos los proyectos */

    Class Conexion {

      protected $pdo;

      public function _construct(){

          try {
               $dsn="mysql:host=" . SERVER . ";dbname=" .BD;

               $options = [ //OPCIONES EN CUANTO A LA CONEXIÓN CON LA BBDD
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_PERSISTENT => false,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . CHARSET ."COLLATE".COLLECTION
               ];

               $this->pdo = new PDO($dsn, USER,PASS, $options);

          } catch (PDOException $e) {
               include('views/partials/error.DB');
               exit();
          }

          echo 'Conexión realizada con éxito';
      }
    }

   
?>