<?php

class EmpleadoDTO
{

    protected $identificacion;
    protected $nombre;
    protected $salario;
    protected $email;
    protected $fechaEntrega;
    protected $estado;
    protected $producto;
    protected $finca;
    
    function __construct($id) {
        $this->identificacion = $id;
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
