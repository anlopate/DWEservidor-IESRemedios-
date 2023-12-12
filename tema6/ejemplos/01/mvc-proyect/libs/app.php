<?php



class App {

    function __construct() {

              
        # El primer elemento de la url es el controlador
        # El segundo es el método del controlador
        # El resto me imagino que son parámetros del método
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;//if reducido
        $url = rtrim($url, '/');//para quitar posibles espacios por la derecha
        $url = explode('/', $url);//convierte $url en un array.Cada elemento de un array está dividio con una /

        print_r($url);
        

        # Si no se introduce ningún controlador en la barra de direcciones
        # cargará el controlador Main.php
        # Si se introduce index también cargará el controlador Main

        if ((empty($url[0])) || ($url[0]=='index')) {//empty($url[0] es que no se indica nada. Carga el main)

            $archivoController = 'controllers/main.php';
            require_once $archivoController; //carga el controlador
            $controller = new Main(); //crea objeto de la clase main
            $controller->loadModel('main'); //
            $controller->render();
            return false; 
        }
        
        $archivoController = 'controllers/' . $url[0] . '.php';
        
        # Carga el controlador sólo si existe el archivo

        if (file_exists($archivoController)) {

            require_once $archivoController;
            $controller = new $url[0];//crea un objeto de la clase que sea el controlador(ej alumnos)
            $controller->loadModel($url[0]);//carga el método loadModel se la clase que se el controlador.

            # obtengo el número de elementos de la dirección
            $nparam = sizeof($url);

            if ($nparam > 1) {

                if ($nparam>2) {

                    $param = [];
                    for ($i=2; $i<$nparam; $i++) {//se inicia en 2 para cragr sólo los parámetroes de la url, no el controlador y el método
                        $param[]=$url[$i];
                    }
                    $controller->{$url[1]}($param);//ejecuta el método de la url ($url[1]) con los parámetros que contenga (Sparam)
                } else {
                    $controller->{$url[1]}();//ejecuta el método sin parámetros
                }
            } else {

                $controller->render();//si no es mayor que 1, ejecuta el método principal
            }


        } else {

            require_once 'controllers/error.php'; //si existe un fallo se carga el controlador.
            $controller = new Errores();
        }

    }
}

?>