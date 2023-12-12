<?php

    class Alumnos Extends Controller {

        /*function __construct() {

            parent ::__construct();
           
            Se puede quitar porque hereda el constructor de la clase padre.
            
        }*/

        function render() {

            $this->view->render('main/index');
        }
    }

?>