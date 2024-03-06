<?php

class movimientosModel extends Model {

    public function get($id){
        try {
                $sql = "SELECT 
                            movimientos.id,
                            cuentas.id as id_cuenta,
                            movimientos.fecha_hora,
                            movimientos.concepto,
                            movimientos.tipo,
                            movimientos.cantidad,
                            movimientos.saldo
                            FROM 
                                movimientos
                            INNER JOIN
                                cuentas ON movimientos.id_cuenta = cuentas.id
                            where cuentas.id = :id
                            ORDER BY movimientos.id";    
                            
                $conexion = $this->db->connect();
                $pdostmt = $conexion->prepare($sql);
            
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);
                $pdostmt->bindParam(':id', $id, PDO::PARAM_INT);
            
                $pdostmt->execute();

                return $pdostmt;
        } catch (PDOException $e) {
            include 'template/partials/error.php';
            exit();
        }
    }

    public function create(classMovimiento $mov_actualizado){
        try {
           
            $sql = "INSERT INTO movimientos (id, id_cuenta, fecha_hora, concepto, tipo, cantidad, saldo) VALUES (
                null,
                :id_cuenta,
                now(),
                :concepto,
                :tipo,
                :cantidad,
                :nuevo_saldo)";
           
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);

          
            $pdostmt->bindParam(':id_cuenta',$mov_actualizado->id_cuenta,PDO::PARAM_INT,10);
            $pdostmt->bindParam(':concepto',$mov_actualizado->concepto,PDO::PARAM_STR,50);
            $pdostmt->bindParam(':tipo',$mov_actualizado->tipo,PDO::PARAM_STR,3);
            $pdostmt->bindParam(':cantidad',$mov_actualizado->cantidad,PDO::PARAM_INT,20);
            $pdostmt->bindParam(':nuevo_saldo',$mov_actualizado->saldo,PDO::PARAM_INT,20);
            

            $pdostmt->execute();

        } catch (PDOException $e) {
            // Obtener el mensaje de error
            $errorMessage = $e->getMessage();
            // Obtener el código de error
            $errorCode = $e->getCode();
            // Obtener información adicional sobre el error
            $errorInfo = $e->errorInfo;
            include 'template/partials/error.php';
            exit();
        }
    }

    public function obtenerCuenta()
    {
        try {
           
            $sql = "SELECT 
                        cuentas.id
                    FROM
                        cuentas
                        ORDER BY id";

           
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

    function validarCuenta($id_cuenta){
        try{
            $sql = "SELECT * FROM cuentas WHERE id = :id_cuenta ";
    
                $conexion = $this->db->connect();
                $pdost = $conexion->prepare($sql);
    
                $pdost->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
                $pdost->execute();
    
                if($pdost->rowCount() != 0){
                    return true;
                }
                return false; //Devuelve false, quiere decir que la cuenta no existe.
            } catch (PDOException $e){
                include_once('template/partials/errorDB.php');
                exit();
                
            }
            }

        function conocerSaldoCuenta ($id_cuenta){
            try{
                $sql = "SELECT saldo FROM cuentas WHERE id = :id_cuenta";
                $conexion = $this->db->connect();
                $pdost = $conexion->prepare($sql);

                $pdost->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
                
                $pdost->execute();
                $result =  $pdost->fetch(PDO::FETCH_OBJ);

                if ($result) {
                    return $result->saldo;
                } else {
                    return 0; 
            } 
        }catch (PDOException $e){
            include_once('template/partials/errorDB.php');
            exit();
    }
    }

    function actualizarCuenta ($id_cuenta, $nuevo_saldo){
        try{
            $sql = "UPDATE cuentas SET saldo = :nuevo_saldo, num_movtos = num_movtos+1 WHERE id = :id_cuenta";

            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':nuevo_saldo', $nuevo_saldo, PDO::PARAM_INT);
            $pdost->bindParam(':id_cuenta', $id_cuenta, PDO::PARAM_INT);
            $pdost->execute();


        }catch (PDOException $e) {
            // Obtener el mensaje de error
            $errorMessage = $e->getMessage();
            // Obtener el código de error
            $errorCode = $e->getCode();
            // Obtener información adicional sobre el error
            $errorInfo = $e->errorInfo;
            include 'template/partials/error.php';
            exit();
    }
}

        public function order(int $criterio, $id){
            try {
            
                $sql ="SELECT 
                            movimientos.id,
                            cuentas.id as id_cuenta,
                            movimientos.fecha_hora,
                            movimientos.concepto,
                            movimientos.tipo,
                            movimientos.cantidad,
                            movimientos.saldo
                            FROM 
                                movimientos
                            INNER JOIN
                            cuentas ON movimientos.id_cuenta = cuentas.id
                            WHERE movimientos.id = :id
                            ORDER BY
                                :criterio ";

            
                $conexion = $this->db->connect();

            
                $pdostmt = $conexion->prepare($sql);
            
                $pdostmt->bindParam(":criterio", $criterio,PDO::PARAM_INT);
                $pdostmt->bindParam(":id", $id,PDO::PARAM_INT);

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
                movimientos.id,
                movimientos.id_cuenta,
                movimientos.fecha_hora,
                movimientos.concepto,
                movimientos.tipo,
                movimientos.cantidad,
                movimientos.saldo
                FROM movimientos
                WHERE CONCAT_WS(' ',
                movimientos.id,
                movimientos.id_cuenta,
                movimientos.fecha_hora,
                movimientos.concepto,
                movimientos.tipo,
                movimientos.cantidad,
                movimientos.saldo)
                 LIKE :expresion";
    
               
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

        public function read($id){
            try {
                  $sql= "  SELECT 
                  movimientos.id,
                  movimientos.id_cuenta,
                  movimientos.fecha_hora,
                  movimientos.concepto,
                  movimientos.tipo,
                  movimientos.cantidad,
                  movimientos.saldo
                  FROM 
                      movimientos
                  where movimientos.id = :id
                  ORDER BY movimientos.id";
    
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
    
}
?>