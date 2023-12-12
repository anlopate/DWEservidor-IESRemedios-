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
                        numSocios FROM clubs";

            $pdostmt = $this->pdo->prepare($sql);
            
            $pdostmt->setFetchMode(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;


        }catch(PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function insert_corredor(Corredor $corredor){
        try{
            $sql = "INSERT 
            INTO corredores VALUES(
                                null,
                                :nombre,
                                :apellidos,
                                :ciudad,
                                :fechaNacimiento,
                                :sexo,
                                :email,
                                :dni,
                                :edad,
                                :id_categoria,
                                :id_club)";

                $pdostmt = $this->pdo->prepare($sql);

                $pdostmt->bindParam(':nombre', $corredor->nombre, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':apellidos', $corredor->apellidos, PDO::PARAM_STR, 50);
                $pdostmt->bindParam(':ciudad', $corredor->ciudad, PDO::PARAM_STR, 20);
                $pdostmt->bindParam(':fechaNacimiento', $corredor->fechaNacimiento);
                $pdostmt->bindParam(':sexo', $corredor->sexo, PDO::PARAM_STR, 2);
                $pdostmt->bindParam(':email', $corredor->email, PDO::PARAM_STR, 10);
                $pdostmt->bindParam(':dni', $corredor->dni, PDO::PARAM_STR, 10);
                $pdostmt->bindParam(':edad', $corredor->edad, PDO::PARAM_INT, 3);
                $pdostmt->bindParam(':id_categoria', $corredor->id_categoria, PDO::PARAM_INT, 5);
                $pdostmt->bindParam(':id_club', $corredor->id_club, PDO::PARAM_INT, 6);

                $pdostmt->execute();

                $pdostmt=null;

                $this->pdo = null;
                                    
        }catch(PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

    public function delete ($id){

        try{
            $sql = "DELETE  FROM corredores WHERE id=$id";

            $pdostmt=$this->pdo->prepare($sql);

            $pdostmt->execute();

            $pdostmt = null;

            $this->pdo = null;


        }catch (PDOException $e){
            include('views/partials/errorDB.php');
            exit();
        }
    }

        public function update(Corredor $corredor, $id){

                try{

                    $sql = "UPDATE corredores SET  
                                    nombre          = :nombre,
                                    apellidos       = :apellidos,
                                    ciudad          = :ciudad,
                                    fechaNacimiento = :fechaNacimiento,
                                    sexo            = :sexo,
                                    email           = :email,
                                    dni             = :dni,
                                    edad            = :edad,
                                    id_categoria    = :id_categoria,
                                    id_club         = :id_club
                                    WHERE id = $id"; 
                    
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
                
                }catch (PDOException $e){
                    include('views/partials/errorDB.php');
                    exit();
                }


            }

        public function read ($id){

            try{

                $sql = "SELECT * FROM corredores WHERE id = $id";
                           

                $pdostmt = $this->pdo->prepare($sql);
                
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt->fetch();

            }catch (PDOException $e){
                    include('views/partials/errorDB.php');
                    exit();
                }

        }

        public function ordenar(int $criterio){

            try{

                $sql = "SELECT * FROM corredores ORDER BY $criterio";

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