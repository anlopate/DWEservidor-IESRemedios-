<?php

    /*
        clase Libro

        Incluirá un atributo por cada columna de la tabla libro
        No cumple la propiedad de encapsulamiento pero si es preciso definir el constructor

    */

    Class Libro{

        public $id;
        public $isbn;
        public $titulo;
        public $autor_id;
        public $editorial_id;
        public $precio_coste;
        public $precio_venta;
        public $stock;
        public $fechaEdicion;

        function __constructor($id,$isbn,$titulo,$autor_id,$editorial_id,$precio_coste,$precioi_venta,$stock,$fechaEdicion){
            $this->id = $id;
            $this->isbn = $isbn;
            $this->titulo = $titulo;
            $this->autor_id = $autor_id;
            $this->editorial_id = $editorial_id;
            $this->precio_coste = $precio_coste;
            $this->precio_venta = $precio_venta;
            $this->stock = $stock;
            $this->fechaEdicion = $fechaEdicion;

        }
       

    }

?>