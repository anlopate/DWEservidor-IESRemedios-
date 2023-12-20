<?php

    class Controller {

        function __construct() {

            $this->view = new View();

        }
        
        function loadModel($model) {

            $url = 'models/' . $model . 'model.php';//$model es el nombre del  modelo
            if (file_exists($url)) {

                require $url;

                $modelName = $model.'Model';
                $this->model = new $modelName();
            }
        }
    }


?>