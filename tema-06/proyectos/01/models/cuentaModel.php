<?php

    class cuentaModel extends Model{

        public function get() {

            try {

                $sql = "SELECT *
                FROM
                   cuentas
                ORDER BY 
                    id
                ";
                

                $conexion = $this->db->connect();
                $pdostmt = $conexion->prepare($sql);
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt;

            } catch (PDOException $e) {
                include_once('template/partials/error.php');
                exit();

            }
        }

       
        public function create(classCuenta $cuenta){

        try {

            $sql = "INSERT INTO cuentas (
                num_cuenta,
                id_cliente,
                fecha_alta,
                fecha_ul_mov,
                num_movtos,
                saldo
                )VALUES(
                :num_cuenta,
                :id_cliente,
                NOW(),
                NOW(),
                1,
                :saldo
                )";

           
            $conexion = $this->db->connect();
            $pdostmt = $conexion->prepare($sql);

            $pdostmt->bindParam(':num_cuenta', $cuenta->num_cuenta);
            $pdostmt->bindParam(':id_cliente', $cuenta->id_cliente);
            $pdostmt->bindParam(':saldo', $cuenta->saldo);

            $pdostmt->execute();

        } catch (PDOException $e) {
            include_once('template/partials/error.php');
            exit();
        }
    }
 
    public function obtenerCliente()
    {
        try {
           
            $sql = "SELECT 
                        clientes.id,
                        clientes.nombre,
                        clientes.apellidos
                    FROM
                        clientes";

           
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

    public function read(int $id){
        try {
            
            $sql = "SELECT 
                    cuentas.num_cuenta,
                    cuentas.id_cliente,
                    cuentas.fecha_alta,
                    cuentas.fecha_ul_mov,
                    cuentas.num_movtos,
                    cuentas.saldo
                     FROM cuentas 
                     WHERE id=:id";

          
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

    public function update(int $id, classCuenta $cuenta){
        try {
            
            $sql= "UPDATE cuentas SET
                    null,
                    null,
                    null,
                    null,
                    null,
                    null,
                    saldo = :saldo
                WHERE id = :id
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);
           
            $pdostmt->bindParam(':saldo',$cuenta->saldo,PDO::PARAM_INT);
        
            $pdostmt->execute();

        } catch (PDOException $e) {
            include 'template/partials/error.php';
            exit();
        }
    }

    public function delete(int $id){
        try {
           
            $sql = "DELETE FROM cuentas WHERE cuentas.id=:id";

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
            cuentas.id,
            cuentas.num_cuenta,
            cuentas.id_cliente,
            cuentas.fecha_alta,
            cuentas.fecha_ul_mov,
            cuentas.num_movtos,
            cuentas.saldo
            FROM cuentas ORDER BY :criterio";

           
            $conexion = $this->db->connect();

           
            $pdostmt = $conexion->prepare($sql);
           
            $pdostmt->bindParam(":criterio", $criterio,PDO::PARAM_INT);

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
            cuentas.id,
            cuentas.num_cuenta,
            cuentas.id_cliente,
            cuentas.fecha_alta,
            cuentas.fecha_ul_mov,
            cuentas.num_movtos,
            cuentas.saldo
            FROM cuentas
            WHERE CONCAT_WS(' ',
            cuentas.id,
            cuentas.num_cuenta,
            cuentas.id_cliente,
            cuentas.fecha_alta,
            cuentas.fecha_ul_mov,
            cuentas.num_movtos,
            cuentas.saldo) LIKE :expresion";

           
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

}

?>