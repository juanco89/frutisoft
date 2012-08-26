<?php

class Application_Model_FincaDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'FINCAS';
    protected  $_primary = 'id';

    public function buscar($id){
        $q = $this->fetchAll(
                $this->select()
                ->setIntegrityCheck(false)
                ->from(array('h' => 'HECTAREAS'),
                        array('num' => new Zend_Db_Expr('COUNT(*)')))
                ->join(array('f' => 'FINCAS'),
                        'h.finca = f.id')
                ->where('f.id = ?', $id)
                );
        if(count( $q ))
        {
            $finca = $q[0];
            $dto = new FincaDTO($finca->id, $finca->nombre,
                                $finca->num, $finca->telefono);
            $dto->ubicacion = $finca->ubicacion;
            $dto->administrador = $finca->identificacion;
            return $dto;
        }
    }

    public function buscarTodos()
    {
        $q = $this->fetchAll();

        $fincas = array();
        foreach($q as $finca)
        {
            $num = $this->fetchAll(
                        $q=$this->select()
                         ->setIntegrityCheck(false)
                        ->from(array('h' => 'HECTAREAS'), array('num' => new Zend_Db_Expr('COUNT(*)')))
                        ->where('h.finca = ?', $finca->id)
                   );

            $dto = new FincaDTO($finca->id, $finca->nombre,
                                $num[0]->num, $finca->telefono);
            $dto->ubicacion = $finca->ubicacion;
            $dto->administrador = $finca->identificacion;
            $fincas[] = $dto;
        }
        return $fincas;
    }
    
    public function insertar($dto)
    {
        $finca = array();
        $finca['nombre'] = $dto->nombre;
        $finca['ubicacion'] = $dto->ubicacion;
        $finca['telefono'] = $dto->telefono;
        $finca['identificacion'] = $dto->administrador;
        //print_r($finca);print_r($dto);die();
        try {
            //Insertar finca y recuperar el id del registro insertado
            $idFinca = $this->insert($finca);

            //Crear las hectáreas en la tabla HECTAREAS
            $hectareaDatos = array(
                'id' => 1,
                'estado' => 1,
                'finca' => $idFinca
            );
            for($i = 0; $i < count($dto->hectareas); $i++)
            {
                $db = $this->getAdapter();
                $db->insert('HECTAREAS', $hectareaDatos);
                $hectareaDatos['id'] += 1;
            }
            return true;
        }  catch (Exception $e) {
            return false;
        }
    }
}
?>