<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  
  require 'PHPMailer/src/Exception.php';
  require 'PHPMailer/src/PHPMailer.php';
  require 'PHPMailer/src/SMTP.php';
  require 'class/classContactar.php';

    class Contactar extends Controller {
        function __construct(){
            parent::__construct();
        }

        function render(){
         
            # Iniciamos o continamo sesión
            session_start();

            # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = 'Usuario debe autentificarse';
                header('location:'. URL . 'login');
            # Pregunta si tiene privilegios para identificarse.
            }else if (!in_array($_SESSION['id_rol'], $GLOBALS['contactar']['main'])){
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'index');
            }else{    
            # Comprobamos si el formulario contiene algún error, es decir, no ha sido validado.
            if(isset($_SESSION['error'])){

                # Mostramos el mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorellena el formulario de nuevo con los datos almacenados en la "sesión contacto" a través del método "unserialize"
                $this->view->contacto = unserialize($_SESSION['contacto']);

                # Recuperamos el array que contiene los errores específicos.
                $this->view->errores = $_SESSION['errores'];

                # Eliminamos las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['contacto']);  
            }

            # Comprobamos si en la sesión existe un mensaje. 
            # Si existe lo mostramos, y a continuación lo borramos.
            if(isset($_SESSION['mensaje'])){
                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
            }
            # Titulo de la página
            $this->view->title = "Formulario de contacto";

            # La vista nos envío al formulario
            $this->view->render('contactar/main/index');
            }
                }
            
           public function validar() {
                
            # Iniciamos o continamo sesión
            session_start();

            # Comprobar si el usuario está autentificado
            if(!isset($_SESSION['id'])) {
                $_SESSION['mensaje'] = 'Usuario debe autentificarse';
                header('location:'. URL . 'login');
            # Pregunta si tiene privilegios para identificarse.
            }else if (!in_array($_SESSION['id_rol'], $GLOBALS['contactar']['main'])){
                $_SESSION['mensaje'] = "Operación sin privilegios";
                header('location:'.URL.'index');
            }else{    
            # Comprobamos si el formulario contiene algún error, es decir, no ha sido validado.
            if(isset($_SESSION['error'])){

                # Mostramos el mensaje de error
                $this->view->error = $_SESSION['error'];

                # Autorellena el formulario de nuevo con los datos almacenados en la "sesión contacto" a través del método "unserialize"
                $this->view->contacto = unserialize($_SESSION['contacto']);

                # Recuperamos el array que contiene los errores específicos.
                $this->view->errores = $_SESSION['errores'];

                # Eliminamos las variables de sesión
                unset($_SESSION['error']);
                unset($_SESSION['errores']);
                unset($_SESSION['contacto']);  
            }

            # Por seguridad saneamos los datos del formulario para evitar posibles inyecciones de código aa través del email no deseado.
            $nombre = filter_var($_POST['nombre'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $email = filter_var($_POST['email'] ??= '', FILTER_SANITIZE_EMAIL);
            $asunto = filter_var($_POST['asunto'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);
            $mensaje = filter_var($_POST['mensaje'] ??= '', FILTER_SANITIZE_SPECIAL_CHARS);

            // Creamos un nuevo objeto contactar para enviar el email.

            $contacto = new classContactar(
                $nombre,
                $email,
                $asunto,
                $mensaje
            );

            // Validación datos recbidos del formulario.
            $errores = [];

            if(empty($nombre)){
                $errores['nombre'] = "El campo nombre es obligatorio";
            }

            if(empty($email)){
                $errores['email'] = "El campo email es obligatorio";
            }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errores['email'] = 'Formato email no es válido.';
            }
           
            if(empty($asunto)){
                $errores['asunto'] = "El asunto es obligatorio";
            }
            if(empty($mensaje)){
                $errores['mensaje'] = "El mensaje es obligatorio";
            }
        
             # Comprobamos validación.
            # Si el array errores contiene algún dato, quiere decir que no se ha realizado la validación.
            # En ese caso se crean diferentes variables de Session que se moostrarán de nuevo en el formulario.
            if(!empty($errores)){
                
                $_SESSION['contacto'] = serialize($contacto);
                // Mensaje de error a mostrar en el formulario.
                $_SESSION['error'] = 'Formulario no ha sido validado';
                // Errores que aparecen en el formulario.
                $_SESSION['errores'] = $errores;

                # Nos redirige de nuevo al formulario.
                header('location:'. URL . 'contactar');
            }else{
               $this->enviarEmail($contacto);
            }
            }
        }


        
       public  function enviarEmail($contacto){
 
        // Creo objeto clase PHPMailer
        $mail = new PHPMailer(true);
        
        // En caso de error lanza Exception
        try { 
        
            // Configuración juego caracteres
            $mail->CharSet = "UTF-8";
            $mail->Encoding = "quoted-printable";
        
            // Credenciales SMPT gmail
            $mail->Username = 'analopezatero@gmail.com';
            $mail->Password = 'nuih reze lgfy znmu';
        
            // Configuración SMPT gmail
            $mail->SMTPDebug = 2;                                       //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication                             //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // tls Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Cabecera del email
            $destinatario = $contacto->email;
            $remitente    = 'analopezatero@gmail.com';
            $asunto       = $contacto->asunto;
            $mensaje      = $contacto->mensaje;
        
            $mail->setFrom($remitente);
            $mail->addAddress($destinatario);
            $mail->addReplyTo($remitente);
           
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $asunto;
            $mail->msgHTML($mensaje);
            
            // Enviamos el mensaje
            $mail->send();
        
            // Mostramos mensaje de confirmación en caso de éxito
            $_SESSION['mensaje'] = 'Mensaje enviado correctamente.';
            header('location:' . URL . 'contactar');
            exit();
            // Mostramos mensaje de error en caso de no poder enviar el mensaje.
            $_SESSION['mensaje'] = 'Error al enviar el mensaje.';
            header('location:' . URL . 'contactar/main');
            exit();
         

    }catch (Exception $e)
    {
        

}
    }
}
    
?>