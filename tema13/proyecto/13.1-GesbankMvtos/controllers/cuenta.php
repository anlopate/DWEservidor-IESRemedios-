<?php

// require ('fpdf/fpdf.php');
require('class/classPDFCuenta.php');
      
    class Cuenta extends Controller{

        function __construct(){
            parent ::__construct();
        }
   

    function render() {

        # Iniciamos o continuamos sesión.
        session_start();

         //Comprobar si el usuario está identificado
         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        }else{
            # Comprobamos si existe un mensaje.
            if(isset($_SESSION['mensaje'])){
            $this->view->mensaje = $_SESSION['mensaje'];
            unset($_SESSION['mensaje']);
            }
         }

       # Título de la página.
        $this->view->title = "Tabla Cuentas";
        # Creamos la propiedad cuentas dentro de la vista.
        # Del modelo asignado al controlador, ejecuto el método get();
        $this->view->cuentas = $this->model->get();
        $this->view->render('cuenta/main/index');
        $this->model->obtenerCliente();
    }

    function new (){

        # Iniciamos o continuamos sesión.
         session_start();

         //Comprobar si el usuario está identificado
         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";

            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        }else{

        # Creamos un objeto vacío.
        $this->view->cuenta = new classCuenta();

        # Comprobamos si vuelvo de un registro no validado.
        if (isset($_SESSION['error'])){
                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorellenar el formulario.
                $this->view->cuenta = unserialize($_SESSION['cuenta']); 

                # Recupero array errores específicos.
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['cuenta']);
        }

        # Título de la página.
        $this->view->title = "Añadir - Gestión Cuentas";
        # Obtenemos la lista de clientes para insertar en la nueva cuenta.
        $this->view->listaClientes = $this->model->obtenerCliente();
        # Cargamos la vista con el formulario nueva cuenta.
        $this->view->render('cuenta/new/index');
    }
   }

    public function create(){

         # Iniciamos o continuamos sesión.
         session_start();
         //Comprobar si el usuario está identificado
         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['new']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        }else{
        # Por seguridad, saneamos los datos recogidos del formulario para evitar inyecciones de código no deseadas.
        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_var($_POST['id_cliente'] ??= FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta'] ??= FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??= FILTER_SANITIZE_NUMBER_FLOAT);
        # Creamos un objeto 'cuenta' con los datos saneados.
         $cuenta = new classCuenta(
             null,
             $num_cuenta,
             $id_cliente,
             $fecha_alta,
             date("d-m-Y H:i:s"),
              1,
              $saldo, 
             null,
             null
         );

         # Realizamos la validación.
         # Creamos array de errores, donde se almacenarán los errores producidos en el formulario.
         $errores = [];

         //Cuenta: obligatoria, 20 digitos númericos y valor único.
         if(empty($num_cuenta)){
            $errores['num_cuenta'] = 'El campo número de cuenta es obligatorio';
         }else if(strlen($num_cuenta) != 20){
            $errores['num_cuenta'] = 'Numero de digítos incorrecto.';
         }else if(!ctype_digit($num_cuenta)){
            $errores['num_cuenta'] = 'La cuenta sólo puede tener valores númericos';
         }else if(!$this->model->validateNumCuentaUnique($num_cuenta)){
            $errores['num_cuenta'] = 'El número de cuenta ya existe.';
         }

         // Cliente: obligatorio, valor número, debe existir en la tabla clientes.
         if(empty($id_cliente)){
            $errores['id_cliente'] = 'El campo es obligatorio.';
         }else if($this->model->clienteExistente($id_cliente)){
            $errores['id_cliente'] = 'El cliente no existe.';
         }
        //  }else if(!ctype_digit($id_cliente)){
        //     $errores['id_cliente'] = 'El id debe ser numérico.';
        //  }

          //Fecha alta. Campo obligatorio, con formato valido
          if (empty($fecha_alta)) {
            $errores['fecha_alta'] = 'El campo fecha alta es obligatorio';
        } else if (!$this->model->validateFechaAlta($fecha_alta)) {
            $errores['fecha_alta'] = 'La fecha no tiene un formato correcto';
        }

         //Saldo: Obligatorio, valor numérico
         if (empty($saldo)) {
            $errores['saldo'] = 'El campo saldo es obligatorio';
         } else if (!is_numeric($saldo)) {
            $errores['saldo'] = 'El campo saldo debe ser numérico';
         }
           # Comprobamos validaciones.
           if(!empty($errores)){
           
            $_SESSION['cuenta'] = serialize($cuenta); 
            $_SESSION['error'] = 'Formulario no ha sido validado.';
            $_SESSION['errores'] = $errores; 

            # Nos redirecciona a new.
            header('location:'. URL.'cuenta/new/index');
       }else{ 
           $this->model->create($cuenta);
           $_SESSION['mensaje'] = 'Cuenta creada correctamente.';
           header('location:'.URL.'cuenta');  
       }

    }
    }


    public function edit($param = []){

       # Iniciamos o continuamos sesión.
       session_start();

        //Comprobar si el usuario está identificado
        if (!isset($_SESSION['id'])) {
         $_SESSION['mensaje'] = "Usuario No Autentificado";

         header("location:" . URL . "login");
     } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
         $_SESSION['mensaje'] = "Operación sin privilegios";
         header('location:' . URL . 'cuenta');
     }else{
       # Obtenemos el id de la cuenta que queremos editar.
       $id = $param[0];
       # Asiganmos id a la propiedad 'id' de la vista.
       $this->view->id = $id;

        # Título de la página.
        $this->view->title = "Editar cuenta";

        # Recuperamos los datos de la cuenta según id.
        $this->view->cuenta = $this->model->read($id);

        # Obtenemos el nombre de los clientes.
        $this->view->listaClientes = $this->model->obtenerCliente();

            # Comprobar si vuelvo de un registro no validado
            if (isset($_SESSION['error'])){

                # Mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorellenar el formulario

                $this->view->cuenta = unserialize($_SESSION['cuenta']); 
                # Recupero array errores específicos
                $this->view->errores = $_SESSION['errores'];

                # Elimino las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['cuenta']);
        }

            # cargo la vista
            $this->view->render('cuenta/edit/index');
        }
      }

    public function update($param = []) {

        # Iniciamos o continuamos sesión.
        session_start();
         //Comprobar si el usuario está identificado
         if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario No Autentificado";
   
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        }else{
        # Por seguridad, saneamos los datos recogidos del formulario para evitar inyecciones de código no deseadas.
        $num_cuenta = filter_var($_POST['num_cuenta'] ??= '', FILTER_SANITIZE_NUMBER_INT);
        $id_cliente = filter_var($_POST['id_cliente'] ??= FILTER_SANITIZE_NUMBER_INT);
        $fecha_alta = filter_var($_POST['fecha_alta'] ??= FILTER_SANITIZE_SPECIAL_CHARS);
        $saldo = filter_var($_POST['saldo']??= FILTER_SANITIZE_NUMBER_FLOAT);
        # Creamos un objeto 'cuenta' con los datos saneados.
         $cuenta = new classCuenta(
             null,
             $num_cuenta,
             $id_cliente,
             $fecha_alta,
             date("d-m-Y H:i:s"),
             0,
             $saldo,
             null,
             null
         );

        # Recuperamos id de la cuenta. 
        $id_editar = $param[0];
       # Leemos la cuenta original.
        $cuenta_orig = $this->model->read($id_cliente);
        # Realizamos la validación.
         # Creamos array de errores, donde se almacenarán los errores producidos en el formulario.
         $errores = [];

         //Cuenta: obligatoria, 20 digitos númericos y valor único.
         // Con strcmp comparamos la cuenta original con la cuenta a editar. Si el resultado de la compración es distinto a cero, quiero decir que son iguales.
         if (strcmp($cuenta->num_cuenta, $cuenta_orig->num_cuenta) !== 0){
                if(empty($num_cuenta)){
                    $errores['num_cuenta'] = 'El campo número de cuenta es obligatorio';
                }else if(strlen($num_cuenta) != 20){
                    $errores['num_cuenta'] = 'Número de dígitos de cuenta incorrectos';
                }else if(!ctype_digit($num_cuenta)){
                    $errores['num_cuenta'] = 'La cuenta sólo puede tener valores númericos';
                }else if(!$this->model->validateNumCuentaUnique($num_cuenta)){
                    $errores['num_cuenta'] = 'El número de cuenta ya existe.';
         }}

         // Cliente: obligatorio, valor número, debe existir en la tabla clientes.
         if (strcmp($cuenta->id_cliente, $cuenta_orig->id_cliente) !== 0){
            if(empty($id_cliente)){
                $errores['id_cliente'] = 'El campo es oblgatorio.';
            }else if($this->model->clienteExistente($id_cliente)){
                $errores['id_cliente'] = 'El cliente no existe';
            }else if(!ctype_digit($id_cliente)){
                $errores['id_cliente'] = 'El id debe ser numérico.';
         }}

          //Fecha alta. Campo obligatorio, con formato valido
          if (strcmp($cuenta->id_cliente, $cuenta_orig->id_cliente) !== 0) {
            if (empty($fecha_alta)) {
                $errores['fecha_alta'] = 'El campo fecha alta es obligatorio';
            } else if (!$this->model->validateFechaAlta($fecha_alta)) {
                $errores['fecha_alta'] = 'La fecha no tiene un formato correcto';
            } }
             //Saldo: Obligatorio, valor numérico
             if (empty($saldo)) {
               $errores['saldo'] = 'El campo saldo es obligatorio';
           } else if (!is_numeric($saldo)) {
               $errores['saldo'] = 'El campo saldo debe ser numérico';
           }
       
           # Comprobamos validaciones.s
           if(!empty($errores)){
           
            $_SESSION['cuenta'] = serialize($cuenta); 
            $_SESSION['error'] = 'Formulario no ha sido validado.';
            $_SESSION['errores'] = $errores; 

            # Nos redirecciona a new.
            header('location:'. URL.'cuenta/edit/' . $id);
       }else{ 
           $this->model->update($id_editar, $cuenta);
           $_SESSION['mensaje'] = 'Cuenta editada correctamente.';
           header('location:'.URL.'cuenta');  
       }
    }
   }

    function delete($param=[]){

       # Iniciamos o continuamos sesión.
       session_start();

       //Comprobar si el usuario está identificado
       if (!isset($_SESSION['id'])) {
         $_SESSION['mensaje'] = "Usuario No Autentificado";

         header("location:" . URL . "login");
     } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
         $_SESSION['mensaje'] = "Operación sin privilegios";
         header('location:' . URL . 'cuenta');
     }else{
        
        $id = $param[0];
        // borramos la cuenta
        $this->model->delete($id);

         //Generar mensasje
         $_SESSION['notify'] = 'Cuenta borrada correctamente';

        header("location:".URL."cuenta");

       }
      }

       function show($param=[]){

       # Iniciamos o continuamos sesión.
       session_start();

       //Comprobar si el usuario está identificado
       if (!isset($_SESSION['id'])) {
         $_SESSION['mensaje'] = "Usuario No Autentificado";

         header("location:" . URL . "login");
     } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['main']))) {
         $_SESSION['mensaje'] = "Operación sin privilegios";
         header('location:' . URL . 'cuenta');
     }else{
           
        $id = $param[0];

        $this->view->id = $id;

        $this->view->title = "Datos de la cuenta";

        $this->view->cuenta = $this->model->read($id);
        // $this->view->cliente = $this->model->obtenerCliente($id);

        $this->view->render('cuenta/show/index');
    }
   }


    function order($param=[]){

         # inicio o continúo sesión
         session_start();

         if (!isset($_SESSION['id'])) {
             $_SESSION['mensaje'] = "Usuario debe autentificarse";
 
             header("location:" . URL . "login");
           
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['order']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        } else {
        $criterio = $param[0];

        $this->view->title = 'Ordenar - Tabla Cuentas';
        $this->view->cuentas = $this->model->order($criterio);

       $this->view->render('cuenta/main/index');
    }
}

    function filter($param=[]){
           
         # inicio o continúo sesión
         session_start();

         if (!isset($_SESSION['id'])) {
             $_SESSION['mensaje'] = "Usuario debe autentificarse";
             header("location:" . URL . "login");
         } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['filter']))) {
             $_SESSION['mensaje'] = "Operación sin privilegios";
             header('location:' . URL . 'cuenta');
         } else {
        $expresion = $_GET['expresion'];

        $this->view->title = 'Filtrar - Tabla Cuentas';

        $this->view->cuentas = $this->model->filter($expresion);

        $this->view->render('cuenta/main/index');
    }
 }  

             // Método para exportar archivo CSV
    function exportCSV(){
        # Inicio o continúo sesión, en este caso del create
        session_start();

        # Comprobar si el usuario está autentificado
         if(!isset($_SESSION['id'])) {
             $_SESSION['mensaje'] = 'Usuario debe autentificarse';

             header('location:'. URL . 'login');

         }else if(!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['exportCSV'])){ 
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:'.URL.'cliente');
         }
         else{
          
           # Recogemos los datos del las cuentas
           $cuentas = $this->model->get();

           # Creamos el archivo CSV donde exportaremos los datos de las cuentas 
           $archivoCSV = 'cuentas' . 'csv';
           # Abrimos un puntero para escribir los datos en el archivo
           $cuentasCSV = fopen($archivoCSV, 'w'); 
           # Añadimos una cabecera al archivo CSV
           fputcsv($cuentasCSV, ['Id','NúmeroCuenta','Cliente','FechaAlta','FechaUltMov','Saldo']);
           # Recorremos todos los datos extraidos de la BBDD y la vamos escribiendo en el archivo CSV.
           foreach($cuentas as $cuenta){
               fputcsv($cuentasCSV, [$cuenta->id,$cuenta->num_cuenta,$cuenta->cliente,$cuenta->fecha_alta,$cuenta->fecha_ul_mov,$cuenta->num_movtos, $cuenta->saldo]);
           }
           # Cerramos el archivo CSV
           fclose($cuentasCSV);

           # Instrucciones para poder descargar el archivo en el navegador:
           // Indicamos que el archivo es de tipo texto.
           header('Content-Type: text/csv');
           // Esto muestra en el navegador una ventana de descarga para el archivo.
           header('Content-Disposition: attachment; filename="' . $archivoCSV . '"');
           // Esto hace que el navegador lea el archivo y lo envíe al cliente.
           readfile($archivoCSV);
   
           // Eliminar el archivo CSV del servidor
           unlink($archivoCSV);
           exit;
    }

   }

    // Muestra formulario subir archivo
    public function subir($param = []){
        # inicio o continúo sesión
        session_start();
        // Compruebo si el usario de ha autenticado.
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
            
        // Compruebo si el usuario tiene permisos para hace esta acción.
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['subir']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');
        }else{
          
           $this->view->id = $param[0];
           $this->view->title = "Subir archivo";

           if(isset($_SESSION['error'])){
            # Mostramos el mensaje de error
            $this->view->error = $_SESSION['error'];
            // # Autorellena el formulario de nuevo con los datos almacenados en la "sesión cliente" a través del método "unserialize"
            // $this->view->cliente = unserialize($_SESSION['cliente']);
            # Recuperamos el array que contiene los errores específicos.
            $this->view->errores = $_SESSION['errores'];
            # Eliminamos las variables de sesión
            unset($_SESSION['error']);
            unset($_SESSION['errores']);
            unset($_SESSION['cuenta']);


        }
           $this->view->render('cuenta/subir/index');
        }
    }

     // Envía archivo cargado en el formulario a la carpeta CSV del proyecto
     public function enviarCSVCarpeta($param = []){
        # inicio o continúo sesión
        session_start();
    
        if (!isset($_SESSION['id'])) {
            $_SESSION['mensaje'] = "Usuario debe autentificarse";
            header("location:" . URL . "login");
        } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['enviarCSVCarpeta']))) {
            $_SESSION['mensaje'] = "Operación sin privilegios";
            header('location:' . URL . 'cuenta');

        }else{
            # Genero array de error de fichero
            $phpFileUploadErrors = array(
               0 => 'There is no error, the file uploaded with success',
               1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
               2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
               3 => 'The uploaded file was only partially uploaded',
               4 => 'No file was uploaded',
               6 => 'Missing a temporary folder',
               7 => 'Failed to write file to disk.',
               8 => 'A PHP extension stopped the file upload.',
           );

        // Compruebo que se ha recibido un archivo.
        if(isset($_FILES['archivo'])){
            $archivo = $_FILES['archivo'];
            $errores = [];
            
            // Compruebo el valor del parámetro error del archivo.
            foreach ($archivo['error'] as $key => $error) {
                 // Si el parámetro error es distinto a 0, algo ha ido mal.
                if($error !== UPLOAD_ERR_OK){
                    $errores['archivo'] = $phpFileUploadErrors[$error];
                    // Si todo ha ido bien, compruebo que contiene el nombre temporal.
                } elseif(is_uploaded_file($archivo['tmp_name'][$key])) {
                     // La clase splFileInfo analiza el archivo y comprueba qué tipo de archivo es.
                    $info = new SplFileInfo($archivo['name'][$key]);
                    $tiposPermitidos = ['csv']; // Permitir solo archivos CSV
                     // strtolower convierte la cadena a minúscula. getExtension, me dice la extensión del archivo que he subido. Comprueba que esa extensión está $tiposPermitidos.
                    if(!in_array(strtolower($info->getExtension()), $tiposPermitidos)){
                        $errores['archivo'] = "Tipo de archivo no permitido.";
                    }
                }
            }
        
            if(!empty($errores)){
                $_SESSION['error'] = 'Error al subir el archivo.';
                $_SESSION['errores'] = $errores;
                header('location:' . URL . 'cuenta/subir');
            } else {
                // Aquí cambia el nombre temporal por el nombre del propio archivo y lo mueve a la carpeta CSV del proyecto.
                foreach ($archivo['name'] as $index => $nombreArchivo) {
                    move_uploaded_file($archivo['tmp_name'][$index], 'CSV/' . $nombreArchivo);
                    // Procesar el archivo después de moverlo
                    $this->importarCSV($nombreArchivo);
                }
                $_SESSION['mensaje'] = 'Archivo subido con éxito';
                header('location:' . URL . 'cuenta');
            }
            }
            }
        }  
    }



    function importarCSV($nombreArchivo){
        if (!isset($_SESSION)) {
            session_start();
        }
       if (!isset($_SESSION['id'])) {
           $_SESSION['mensaje'] = "Usuario debe autentificarse";
           header("location:" . URL . "login");
       } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['enviarCSVCarpeta']))) {
           $_SESSION['mensaje'] = "Operación sin privilegios";
           header('location:' . URL . 'cuenta');

       }else{
          
           $archivo = URL . 'CSV/' . $nombreArchivo;
           # Obtenemos el contenido del archivo
           $contenido = file_get_contents($archivo);
           $lineas= explode("\n", $contenido);

           foreach($lineas as $linea){
               $campos = str_getcsv($linea);
               $cuenta = new classCuenta(
               $id = null, 
               $num_cuenta = $campos[0],
               $cliente = $campos[1],
               $fecha_alta = null,
               $fecha_ult_mov = null,
               $num_movtos = $campos[4],
               $saldo = $campos[5]);
                $this->model->create($cuenta);
                # Se crea una variable de sesión con el mensaje de éxito a mostrar en el formulario.
                $_SESSION['mensaje'] = 'Cuenta CSV creada correctamente.';
                # Nos redirige al main de cliente.
                header('location:' . URL . 'cuenta');   
                }
                if (!unlink('CSV/' . $nombreArchivo)) {
                   echo "Error al eliminar el archivo: $archivo";
               }
           }
        }
 
        function PDF(){

            # inicio o continúo sesión
           session_start();
           // Compruebo si el usario de ha autenticado.
           if (!isset($_SESSION['id'])) {
               $_SESSION['mensaje'] = "Usuario debe autentificarse";
               header("location:" . URL . "login");
              
           // Compruebo si el usuario tiene permisos para hace esta acción.
           } else if ((!in_array($_SESSION['id_rol'], $GLOBALS['cuenta']['subir']))) {
               $_SESSION['mensaje'] = "Operación sin privilegios";
               header('location:' . URL . 'cuenta');
               
           }else{
              // ob_start: esto evita que si hay una salida de datos previa  a la creación del PDF, se guarde en un búfer y no se lance directamente al navegador. Para evitar que el formato del pdf no se vea afectado.
               ob_start();
               $pdf = new classPDFCuenta();
               $pdf->SetFont('Arial','',12);
               $pdf->AliasNbPages();
               $pdf->addPage();
               // $pdf->Header();
               $pdf->titulo();
               $pdf->encabezado();
               
               $cuentas = $this->model->get();
               
               foreach($cuentas as $cuenta){
                   $pdf-> Cell(60, 10, iconv('UTF-8','ISO-8859-1', $cuenta->cliente),1,0,'C');
                   $pdf-> Cell(60, 10, iconv('UTF-8','ISO-8859-1', $cuenta->num_cuenta),1,0,'C');
                   $pdf-> Cell(40, 10, iconv('UTF-8','ISO-8859-1', $cuenta->fecha_alta),1,0,'C');
                   $pdf-> Cell(30, 10, iconv('UTF-8','ISO-8859-1', $cuenta->saldo),1,0,'C');
                   $pdf->Ln();
                     // Esto añade encbezado de tabla a cada página que se crea.
                   if ($pdf->GetY() > 250) {
                    $pdf->addPage();
                    $pdf->encabezado();
                }
                 
                   
               }
            //    $pdf->Footer();
               // ob_clean: Borra los posibles datos almacenados en el búfer con ob_start.
               ob_clean();
               $pdf->Output();
                // ob_end_flush: envía el bufer de salida con los datos actuales.
               ob_end_flush();

       }

       }
   

           
       
   
        

    
?>