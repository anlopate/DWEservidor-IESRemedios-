<?php

class classCuenta {

    public $id;
    public $num_cuenta;
    public $id_cliente;
    public $fecha_alta;
    public $saldo;
   


    public function __construct(
        $id             = null,
        $num_cuenta     = null,
        $id_cliente     = null,
        $fecha_alta     = null,
        $saldo          = null,
       

    ){
        $this->id           = $id;
        $this->num_cuenta   = $num_cuenta ;
        $this->id_cliente   = $id_cliente ;
        $this->saldo        = $saldo ;
       
        
    }

    

}

?>