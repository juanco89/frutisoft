<?php

class PedidoDTO
{

    protected $id;
    protected $cantidad;
    protected $fechaRealizacion;
    protected $fechaEsperada;
    protected $fechaEntrega;
    protected $estado;
    protected $producto;
    protected $finca;
    
    function __construct($id) {
        $this->id = $id;
    }
    
    /* Magic */
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
}
?>
