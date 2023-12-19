    <?php

    /*
        Clase libros 

        Aquí se definirán los métodos necesarios para completar el examen
        
    */

    Class Libros extends Conexion {


        public function getLibros(){

            try{

                $sql = "SELECT 
                    libros.id,
                    libros.titulo,
                    autores.nombre as autor,
                    editoriales.nombre as editorial,
                    libros.stock as unidades,
                    libros.precio_coste as coste,
                    libros.precio_venta as pvp
                    FROM libros
                    INNER JOIN autores ON libros.autor_id = autores.id
                    INNER JOIN editoriales ON libros.editorial_id = editoriales.id
                    ORDER BY id";
                    
                $pdostmt = $this->pdo->prepare($sql);
                
                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt;

            }catch (PDOException $e){
                include('views/partials/partial.errorDB.php');
                exit();
            }

        }

        public function getAutores(){

            try{

                $sql = "SELECT 
                        id,
                        nombre
                        FROM autores
                        ORDER BY nombre";

                $pdostmt = $this->pdo->prepare($sql);

                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt;

            }catch (PDOException $e){
                include('views/partials/partial.errorDB.php');
                exit();
            }
        }

        
        public function getEditoriales(){

            try{

                $sql = "SELECT 
                        id,
                        nombre
                        FROM editoriales
                        ORDER By nombre";

                $pdostmt = $this->pdo->prepare($sql);

                $pdostmt->setFetchMode(PDO::FETCH_OBJ);

                $pdostmt->execute();

                return $pdostmt;

            }catch (PDOException $e){
                include('views/partials/partial.errorDB.php');
                exit();
            }
        }

        public function crear(Libro $libro){

            try{

                $sql = "INSERT INTO libros VALUES (
                   null,
                    :isbn,
                    null,
                    :titulo,
                    :autor_id,
                    :editorial_id,
                    :precio_coste,
                    :precio_venta,
                    :stock,
                    null,
                    null,
                    :fechaEdicion,
                    null,
                    null)";
            
            $pdostmt=$this->pdo->prepare($sql);

            $pdostmt->bindParam(':isbn', $libro->isbn, PDO::PARAM_STR, 20);
            $pdostmt->bindParam(':titulo', $libro->titulo, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':autor_id', $libro->autor_id, PDO::PARAM_STR, 50);
            $pdostmt->bindParam(':editorial_id', $libro->editorial_id, PDO::PARAM_STR, 20);
            $pdostmt->bindParam(':precio_coste', $libro->precio_coste);
            $pdostmt->bindParam(':precio_venta', $libro->precio_venta, PDO::PARAM_STR);
            $pdostmt->bindParam(':stock', $libro->stock, PDO::PARAM_INT, 4);
            $pdostmt->bindParam(':fechaEdicion', $libro->fechaEdicion);

            $pdostmt->execute();

            $pdostmt = null;

            $this->pdo = null;



        }catch (PDOException $e){
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }

    public function order (int $criterio){

        try{

            $sql = "SELECT 
                        libros.id,
                        libros.titulo,
                        autores.nombre as autor,
                        editoriales.nombre as editorial,
                        libros.stock as unidades,
                        libros.precio_coste as coste,
                        libros.precio_venta as pvp
                        FROM libros
                        INNER JOIN autores ON libros.autor_id = autores.id
                        INNER JOIN editoriales ON libros.editorial_id = editoriales.id
                        ORDER BY $criterio";

            $pdostmt= $this->pdo->prepare($sql);

            $pdostmt->setModeFetch(PDO::FETCH_OBJ);

            $pdostmt->execute();

            return $pdostmt;
            
        }catch (PDOException $e){
            include('views/partials/partial.errorDB.php');
            exit();
        }
    }
    }

?>