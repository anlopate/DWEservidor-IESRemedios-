<?php

    class cuentaModel extends Model{

        public function get() {

            try {

                $sql = "
                SELECT 
                    cuentas.id,
                    cuentas.num_cuenta,
                    cuentas.id_cliente,
                    cuentas.fecha_alta,
                    cuentas.fecha_ul_mov,
                    cuentas.num_movtos,
                    cuentas.saldo,
                    cuentas.create_at,
                    cuentas.update_at
                FROM
                   cuentas
                
                ORDER BY 
                    id
                ";

                $conexion = $this->db->connect();

                $pdost = $conexion->prepare($sql);

                $pdost->setFetchMode(PDO::FETCH_OBJ);

               
                $pdost->execute();

                return $pdost;

            } catch (PDOException $e) {

                include_once('template/partials/error.php');
                exit();

            }
        }

       
        public function create(classCuenta $cuenta) {

            try {
            $sql = "
                    INSERT INTO cuentas (
                        null,
                        num_cuenta,
                        id_cliente,
                        fecha_alta,
                        null,
                        null,
                        saldo,
                        null,
                        null
                    )
                    VALUES (
                        null,
                        :num_cuenta,
                        :id_cliente,
                        :fecha_alta,
                        null,
                        null,
                        :saldo,
                        null,
                        null
                    )
            ";
            
             $conexion = $this->db->connect();

             $pdoSt = $conexion->prepare($sql);
 
             $pdoSt->bindParam(':num_cuenta', $cuenta->num_cuenta, PDO::PARAM_INT, 50);
             $pdoSt->bindParam(':id_cliente', $cuenta->id_cliente, PDO::PARAM_INT, 3);
             $pdoSt->bindParam(':fecha_alta', $cuenta->fecha_alta);
             $pdoSt->bindParam(':saldo', $cuenta->saldo, PDO::PARAM_INT, 10);
             
             
             $pdoSt->execute();

         }  catch (PDOException $e) {
             include_once('template/partials/error.php');
             exit();
         }
 

    }

}

?>