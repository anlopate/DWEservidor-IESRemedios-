<?php

    class Login Extends Controller {


        public function render() {

            # Iniciar o continuar sesión segura.
            session_start();

            # Inicializo los valores del formulario.
            $this->view->email = null;
            $this->view->password = null;

            # Control de los mensajes
            if (isset($_SESSION['mensaje'])) {

                $this->view->mensaje = $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);

                # Autorelleno en caso de registro fallido. Si no se registra vuelve al método render para rellenar el formulario.

                if (isset($_SESSION['email'])) {
                    $this->view->email =$_SESSION['email'];
                    unset($_SESSION['email']);
                }

                if (isset($_SESSION['password'])) {
                    $this->view->password =$_SESSION['password'];
                    unset($_SESSION['password']);
                }

            }

            # Control de errores.
            if (isset($_SESSION['error'])) {

                $this->view->error = $_SESSION['error'];
                unset($_SESSION['error']);

                # Autocompleto los valores del formulario.
                $this->view->email = $_SESSION['email'];
                $this->view->password = $_SESSION['password'];
                unset($_SESSION['email']);
                unset($_SESSION['password']);

                # Tipo de error.
                $this->view->errores = $_SESSION['errores'];
                unset($_SESSION['errores']);

            }

            $this->view->render('login/index');
        }

        # 
        # Validación login
        #
        public function validate() {

            # Inicio o reanudación de sesión.
            session_start();

            # Saneamos el formulario.
            $email = filter_var($_POST['email'] ??='',FILTER_SANITIZE_EMAIL);
	        $password = filter_var($_POST['password'] ??='',FILTER_SANITIZE_STRING);

            # Validaciones.

            $errores = array();

            # Obtengo el usuario a partir del email.
	        $user = $this->model->getUserEmail($email); // Devuelve true si existe o false, si no existe.

            if ($user === false) {

                $errores['email'] = "Email no ha sido registrado";
                $_SESSION['errores'] = $errores;
                // Esta parte es para el autorelleno. No es obligatorio.
                $_SESSION['email'] = $email;  
                $_SESSION['password'] = $password;
                
                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:". URL. "login"); 
                
            } else if (!password_verify($password,$user->password)) {

                $errores['password'] = "Password no es correcto";
                $_SESSION['errores'] = $errores;
                // Esta parte es para el autorelleno. No es obligatorio.
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;

                $_SESSION['error'] = "Fallo en la Autentificación";

                header("location:". URL. "login"); 
                
            } else {
                
                # Autentificación completada.
                $_SESSION['id'] = $user->id;
                $_SESSION['name_user'] = $user->name;
                $_SESSION['id_rol'] = $this->model->getUserIdPerfil($user->id);
                $_SESSION['name_rol'] = $this->model->getUserPerfil($_SESSION['id_rol']); // Paso el id del rol y devuelve el nombre del rol.

                $_SESSION['mensaje'] = "Usuario ". $user->name. " ha iniciado sesión" ;
                
                header("location:". URL. "cliente");
            }


        }
    }

?>