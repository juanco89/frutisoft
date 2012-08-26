<?php

class FincaDTO
{

    protected $id;
    protected $nombre;
    protected $ubicacion;
    protected $telefono;
    protected $administrador;
    protected $hectareas;

    function __construct($id , $nombre, $numHectareas = 0, $telefono = '') {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        if($numHectareas != 0)
            $this->hectareas = range(1, $numHectareas);
        else
            $this->hectareas = array();
    }

    /* Magic */
    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
    
    public function agregarHectarea(){
        $ult = end($this->hectareas);
        $this->hectareas[] = $ult + 1;
    }
}
?>
