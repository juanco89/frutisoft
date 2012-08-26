<?php

class CargoDTO
{

    protected $id;
    protected $nombre;

    function __construct($id , $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
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

