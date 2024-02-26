<?php
// require 'class/classContactar.php';
require 'controllers/Contactar.php';

    class Register Extends Controller {
        # muestra formulario de registro
        public function render() {

            # iniciamos o continuar sessión
            session_start();

            # Si existe algún mensaje . Puede que no entre nunca aquí.
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);

            }

            # Inicializamos los campos del formulario
            $this->view->name = null;
            $this->view->email = null; //clave secundaria
            $this->view->password = null; // no es clave secundaria. Se puede repetir.

            if (isset($_SESSION['error'])) {

                # Mensaje de error. 
                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Variables de autorrelleno en caso que venga de un NO validación.
                $this->view->name = $_SESSION['name'];
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                // Borro las variables de sesión pero los datos que obtenidos por éstas se guardan en las variables.
                unset($_SESSION['name']);
                unset($_SESSION['email']);
                unset($_SESSION['password']);

                # Tipo de error
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }
        
            $this->view->render('register/index');
        }
    

    public function validate() {

        # Iniciamos o continuamos con la sesión
        session_start();

        # Saneamos el formulario
        $name = filter_var($_POST['name'],FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'],FILTER_SANITIZE_SPECIAL_CHARS);
        $password_confirm = filter_var($_POST['password-confirm'],FILTER_SANITIZE_SPECIAL_CHARS);

        # Validaciones

        $errores = array();

        # Validar name
        if(empty($name)){
            $errores['name'] = "Campo obligatorio";
        }else if (!$this->model->validateName($name)){
            $errores['name'] = "Nombre de usuario no permitido";
        }
        # Validar Email
        if(empty($email)){
            $errores['email'] = "Campo obligatorio";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = "Email: Email no válido";
        } elseif (!$this->model->validateEmailUnique($email)) {
            $errores['email'] = "Email existente, ya está registrado";
        }

        # Validar password
        if(empty($password)){
            $errores['password'] = "Campo obligatorio";
        }else if (strcmp($password, $password_confirm) !== 0) {
            $errores['password'] = "Password no coincidentes";
        } else if (!$this->model->validatePass($password)) {
            $errores['password'] = "Password: No permitido";
        }

        if (!empty($errores)) {

            $_SESSION['errores'] = $errores;
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['error'] = "Fallo en la validación del formulario";
            
            header("location:". URL. "register");
   
        } else {
            
            # Añade nuevo usuario
            $this->model->create($name, $email, $password);
    
            $_SESSION['mensaje'] = "Usuario registrado correctamente";
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password; 

            # Creamos un nuevo contacto para enviar email.
            $contacto = new classContactar(
                $nombre = $name,
                $email =  $email,
                $asunto = 'Bienvenido a nuestra web',
                $mensaje = "<h2>¡Bienvenido!</h2><br> Su resgistro se ha completado correctamente.<br><br> Para sus próximas conexiones le recordamos sus datos de registro:<br><br>- <b>Nombre</b>: $nombre.<br>- <b>Usuario</b>: $email.<br>-<b> Password</b>: $password<br><br>Gracias por confiar en nosostros.<br><br> <h2>¡Hasta pronto!</h2>");

            # Instaciamos la clase Contactar para enviar un email.

            $this->contactar = new Contactar();
            $this->contactar->enviarEmail($contacto);    

            
            #Vuelve login
            header("location:". URL. "login");// Envía los valores introducidos en el registro a la pantalla de login para entrar en la bbdd. Se puede poner o no.
        }
        


    }

}

?>