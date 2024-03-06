<?php

    class cuentaModel extends Model{

        public function get() {

            try {

                $sql = "SELECT 
                    cuentas.id,
                    cuentas.num_cuenta,
                    concat_ws(', ',clientes.apellidos, clientes.nombre) as cliente,
                    cuentas.id_cliente,
                    cuentas.fecha_alta,
                    cuentas.fecha_ul_mov,
                    cuentas.num_movtos,
                    cuentas.saldo
                FROM
                   cuentas
                   INNER JOIN
                   clientes ON cuentas.id_cliente = clientes.id 
                ORDER BY 
                   cuentas.id";
                
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
                        concat_ws(',' , clientes.apellidos, clientes.nombre) as cliente
                    FROM
                        clientes
                        ORDER BY apellidos, nombre;";

           
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

    public function read($id){
        try {
              $sql= "  SELECT 
                cuentas.num_cuenta,
                concat_ws(',', clientes.apellidos, clientes.nombre) as cliente,
                cuentas.fecha_alta,
                cuentas.fecha_ul_mov,
                cuentas.num_movtos,
                cuentas.saldo
                FROM
                cuentas
                INNER JOIN
                clientes ON cuentas.id_cliente = clientes.id WHERE cuentas.id = :id";

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

    public function update($id, $cuenta){
        try {
            
            $sql= "UPDATE cuentas SET
                    num_cuenta   = :num_cuenta,
                    id_cliente   = :id_cliente,
                    fecha_alta   = :fecha_alta,
                    fecha_ul_mov = :fecha_ul_mov,
                    num_movtos   = :num_movtos,
                    saldo        = :saldo,
                    update_at = now()
                WHERE id = :id
                ";

            $conexion = $this->db->connect();

            $pdostmt = $conexion->prepare($sql);
           
            $pdostmt->bindParam(":id", $id, PDO::PARAM_INT);
            $pdostmt->bindParam(":num_cuenta", $cuenta->num_cuenta, PDO::PARAM_STR, 20);
            $pdostmt->bindParam(":id_cliente", $cuenta->id_cliente, PDO::PARAM_INT);
            $pdostmt->bindParam(":fecha_alta", $cuenta->fecha_alta, PDO::PARAM_STR);
            $pdostmt->bindParam(":fecha_ul_mov", $cuenta->fecha_ul_mov, PDO::PARAM_STR);
            $pdostmt->bindParam(":num_movtos", $cuenta->num_movtos, PDO::PARAM_INT);
            $pdostmt->bindParam(":saldo", $cuenta->saldo, PDO::PARAM_INT);
        
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
                    cuentas.saldo,
                    concat_ws(', ', clientes.apellidos, clientes.nombre) as cliente
                FROM 
                cuentas
                    INNER JOIN 
                    clientes 
                    ON cuentas.id_cliente=clientes.id 
                ORDER BY
                    :criterio ";

           
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
           
            $sql =" SELECT 
            cuentas.id,
            cuentas.num_cuenta,
            cuentas.id_cliente,
            cuentas.fecha_alta,
            cuentas.fecha_ul_mov,
            cuentas.num_movtos,
            cuentas.saldo,
            CONCAT_WS(', ', clientes.apellidos, clientes.nombre) AS cliente
        FROM 
            cuentas
        INNER JOIN 
            clientes 
        ON cuentas.id_cliente=clientes.id 
        WHERE CONCAT_WS(' ',
            cuentas.id,
            cuentas.num_cuenta,
            cuentas.id_cliente,
            cuentas.fecha_alta,
            cuentas.fecha_ul_mov,
            cuentas.num_movtos,
            cuentas.saldo,
            CONCAT_WS(', ', clientes.apellidos, clientes.nombre)
        ) LIKE :expresion";

           
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

    public function validateNumCuentaUnique ($num_cuenta){

        try{
            $sql = "SELECT * FROM cuentas WHERE num_cuenta = :num_cuenta";

            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':num_cuenta', $num_cuenta, PDO::PARAM_INT);
            $pdost->execute();

            if($pdost->rowCount() != 0){
                return false;
            }
            return true; //Devuelve true, quiere decir que está validado.

    }catch (PDOException $e){
            include_once('template/partials/error.php');
            exit();
            


        }
    }

    public function clienteExistente ($id_cliente){
        try{
            $sql = "SELECT * FROM clientes WHERE id = :id_cliente";

            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);

            $pdost->bindParam(':id_cliente', $id_cliente,  PDO::PARAM_INT);
            $pdost->execute();

            if($pdost->rowCount() != 0){
                return false;
            }return true;
            
        }catch (PDOException $e){
            include_once('template/partials/error.php');
            exit();
        }
    }

    public function validateFechaAlta($fecha_alta){
        $formatoFecha = date('d-m-Y H:i:s');
        if($formatoFecha !== false){
            return true;
        } else {
            return false;
        }

    }
}

?>