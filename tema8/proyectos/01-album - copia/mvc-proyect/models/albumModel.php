<?php

    /*
        albumModel.php

        Modelo del  controlador album

        Definir los métodos de acceso a la base de datos
        
        - insert
        - update
        - select
        - delete
        - etc..
    */

    class albumModel extends Model {

        /*
            Extrae los detalles  de los albumes
        */
        public function get() {

            try {

                # comando sql
                $sql = " SELECT 
                    albumes.id,
                    albumes.titulo,
                    albumes.descripcion,
                    albumes.autor,
                    albumes.fecha,
                    albumes.lugar,
                    albumes.categoria,
                    albumes.etiquetas,
                    albumes.num_fotos,
                    albumes.num_visitas,
                    albumes.carpeta
                FROM
                    albumes
                ORDER BY 
                    id ";
               
                # conectamos con la base de datos
                // $this->db es un objeto de la clase database
                // ejecuto el método connect de esa clase

                $conexion = $this->db->connect();

                # ejecutamos mediante prepare
                $pdost = $conexion->prepare($sql);

                # establecemos  tipo fetch
                $pdost->setFetchMode(PDO::FETCH_OBJ);

                #  ejecutamos 
                $pdost->execute();

                # devuelvo objeto pdostatement
                return $pdost;

            } catch (PDOException $e) {

                include_once('template/partials/errorDB.php');
                exit();

            }
        }

       

        public function create(classAlbum $album) {

            try {
            $sql = "INSERT INTO Albumes (
                        titulo,
                        descripcion,
                        autor,
                        fecha,
                        lugar,
                        categoria,
                        etiquetas,
                        num_fotos,
                        num_visitas,
                        carpeta
                    )
                    VALUES (
                        :titulo,
                        :descripcion,
                        :autor,
                        :fecha,
                        :lugar,
                        :categoria,
                        :etiquetas,
                        :num_fotos,
                        :num_visitas,
                        :carpeta
                    ) ";
           
                    
             # Conectar con la base de datos
             $conexion = $this->db->connect();

             $pdoSt = $conexion->prepare($sql);
 
             $pdoSt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
             $pdoSt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 150);
             $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
             $pdoSt->bindParam(':fecha', $album->fecha);
             $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 30);
             $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 20);
             $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 10);
             $pdoSt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
             $pdoSt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
             $pdoSt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 20);
 
             $pdoSt->execute();

             // Creamos la carpeta donde almacenaremos las imágenes del album.
             mkdir('images/' . $album->carpeta);

         }  catch (PDOException $e) {
             include_once('template/partials/errorDB.php');
             exit();
         }

        }

        public function read($id) {

            try {
                $sql =" SELECT 
                            id,
                            titulo,
                            descripcion,
                            autor,
                            fecha,
                            lugar,
                            categoria,
                            etiquetas,
                            num_fotos,
                            num_visitas,
                            carpeta
                        FROM 
                            albumes
                        WHERE
                            id = :id";
                       

                # Conectar con la base de datos
                $conexion = $this->db->connect();

    
                $pdoSt = $conexion->prepare($sql);
    
                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);
                $pdoSt->setFetchMode(PDO::FETCH_OBJ);
                $pdoSt->execute();
                
                return $pdoSt->fetch();
    
            } catch (PDOException $e) {
                include_once('template/partials/errorDB.php');
                exit();
            }

        }

        public function update(classAlbum $album, $id) {

            try {

                $sql = " UPDATE albumes SET
                        nombre      = :nombre,
                        apellidos   = :apellidos,
                        email       = :email,
                        telefono    = :telefono,
                        poblacion   = :poblacion,
                        dni         = :dni,
                        fechaNac    = :fechaNac,
                        id_curso    = :id_curso
                        titulo      = :titulo,
                        descripcion = :descripcion,
                        autor       = :autor,
                        fecha       = :fecha,
                        lugar       = :lugar,
                        categoria   = :categoria,
                        etiquetas   = :etiquetas,
                        num_fotos   = :num_fotos,
                        num_visitas = :num_visitas,
                        carpeta     = :carpeta
                    WHERE
                            id = :id
                    LIMIT 1 ";
                
               
               

                $conexion = $this->db->connect();
                
                $pdoSt = $conexion->prepare($sql);

                $pdoSt->bindParam(':id', $id, PDO::PARAM_INT);

                $pdoSt->bindParam(':titulo', $album->titulo, PDO::PARAM_STR, 100);
                $pdoSt->bindParam(':descripcion', $album->descripcion, PDO::PARAM_STR, 150);
                $pdoSt->bindParam(':autor', $album->autor, PDO::PARAM_STR, 50);
                $pdoSt->bindParam(':fecha', $album->fecha);
                $pdoSt->bindParam(':lugar', $album->lugar, PDO::PARAM_STR, 30);
                $pdoSt->bindParam(':categoria', $album->categoria, PDO::PARAM_STR, 20);
                $pdoSt->bindParam(':etiquetas', $album->etiquetas, PDO::PARAM_STR, 10);
                $pdoSt->bindParam(':num_fotos', $album->num_fotos, PDO::PARAM_INT);
                $pdoSt->bindParam(':num_visitas', $album->num_visitas, PDO::PARAM_INT);
                $pdoSt->bindParam(':carpeta', $album->carpeta, PDO::PARAM_STR, 20);

                $pdoSt->execute();

        }
        catch(PDOException $e) {
            include_once('template/partials/errorDB.php');
            exit();
        }

        }



     
        public function order(int $criterio) {

            try {

                # comando sql
                $sql = "SELECT 
                        albumes.id,
                        albumes.titulo,
                        albumes.descripcion,
                        albumes.autor,
                        albumes.fecha,
                        albumes.lugar,
                        albumes.categoria,
                        albumes.etiquetas,
                        albumes.num_fotos,
                        albumes.num_visitas,
                        albumes.carpeta
                        FROM
                            albumes
                        ORDER BY 
                            :criterio";
                        
                # conectamos con la base de datos
                // $this->db es un objeto de la clase database
                // ejecuto el método connect de esa clase

                $conexion = $this->db->connect();

                # ejecutamos mediante prepare
                $pdost = $conexion->prepare($sql);

                $pdost->bindParam(':criterio', $criterio, PDO::PARAM_INT);

                # establecemos  tipo fetch
                $pdost->setFetchMode(PDO::FETCH_OBJ);

                #  ejecutamos 
                $pdost->execute();

                # devuelvo objeto pdostatement
                return $pdost;

            } catch (PDOException $e) {

                include_once('template/partials/errorDB.php');
                exit();

            }
        }

        public function filter($expresion) {
            try {
                $sql = " SELECT 
                            id,
                            titulo,
                            descripcion,
                            autor,
                            fecha,
                            lugar,
                            categoria,
                            etiquetas,
                            num_fotos,
                            num_visitas,
                            carpeta
                        FROM 
                            albumes
                        WHERE
                           CONCAT_WS( ',',
                                albumes.id,
                                albumes.titulo,
                                albumes.descripcion,
                                albumes.autor,
                                albumes.fecha,
                                albumes.lugar,
                                albumes.categoria,
                                albumes.etiquetas,
                                albumes.num_fotos,
                                albumes.num_visitas,
                                albumes.carpeta)
                                LIKE :EXPRESION
                                ORDER BY albumes.id";

        

                # Conectar con la base de datos
                $conexion = $this->db->connect();

                $pdost = $conexion->prepare($sql);
                
                $pdost->bindValue(':expresion', '%'.$expresion.'%', PDO::PARAM_STR);
                $pdost->setFetchMode(PDO::FETCH_OBJ);
                $pdost->execute();
                return $pdost;

            } catch (PDOException $e){

                include_once('template/partials/errorDB.php');
                exit();
                
            }

    } 

    # Validación email único
    public function validateUniqueEmail($email) {
        try {

            $sql = " 

                SELECT * FROM alumnos 
                WHERE email = :email
            
            ";

            # conectamos con la base de datos
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':email', $email, PDO::PARAM_STR);
            $pdost->execute();

            if ($pdost->rowCount() != 0) {
                return FALSE;
            }

            return TRUE;


        } catch(PDOException $e) {

            include_once('template/partials/errorDB.php');
            exit();

        }
    }

    public function delete($id)  {
        try {

            $sql = "DELETE FROM albumes WHERE id = :id limit 1";
            $conexion = $this->db->connect();
            $pdost = $conexion->prepare($sql);
            $pdost->bindParam(':id', $id, PDO::PARAM_INT);
            $pdost->execute();

        } catch (PDOException $e) {
            
            include_once('template/partials/errorDB.php');
            exit();
            
        }
    }

    public function subirACarpeta($archivo, $carpetaImagen){
        # Generar un array de errores de fichero
    $fileUploadErrors = array(
        0 => 'No hay errores, el archivo se cargó con éxito',
        1 => 'El archivo subido excede la directiva upload_max_filesize en php.ini',
        2 => 'El archivo subido excede la directiva MAX_FILE_SIZE especificada en el formulario HTML',
        3 => 'El archivo subido se cargó solo parcialmente',
        4 => 'No se cargó ningún archivo',
        6 => 'Falta una carpeta temporal',
        7 => 'Error al escribir el archivo en el disco.',
        8 => 'Una extensión de PHP detuvo la carga del archivo.',
    );

    $errores = []; // Almacenará los errores encontrados en los archivos

    # Validar cada archivo subido
    foreach ($archivos['name'] as $index => $nombreArchivo) {
        # Comprobar si hay errores
        if ($archivos['error'][$index] !== UPLOAD_ERR_OK) {
            $errores[] = $fileUploadErrors[$archivos['error'][$index]];
        } else {
            # Validar el tamaño máximo
            $maxSize = 5 * 1024 * 1024; // 5 MB
            if ($archivos['size'][$index] > $maxSize) {
                $errores[] = "El tamaño del archivo '$nombreArchivo' excede el límite de 5MB.";
            }

            # Validar el tipo de archivo
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            $fileInfo = new SplFileInfo($nombreArchivo);
            $extension = $fileInfo->getExtension();

            if (!in_array(strtolower($extension), $allowedExtensions)) {
                $errores[] = "El archivo '$nombreArchivo' no es una imagen JPG, JPEG, PNG o GIF.";
            }
        }
    }

    # Si hay errores en algún archivo, cancelar la subida de todos los archivos
    if (!empty($errores)) {
        $_SESSION['error'] = implode(PHP_EOL, $errores);
        return; // Terminar el proceso de subida de archivos
    }

    # Si no hay errores, se procede a mover los archivos a la carpeta del álbum
    foreach ($archivos['name'] as $index => $nombreArchivo) {
        move_uploaded_file($archivos['tmp_name'][$index], 'imagens/'.$carpetaImagen . '/' . $nombreArchivo);
    }
    
    # Añadimos un mensaje  de confirmación
    $_SESSION['mensaje'] = "Se han subido correctamente las imagenes";
}


    }
   
    

?>