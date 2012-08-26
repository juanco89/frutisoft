<?php

class Application_Model_CargoDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'CARGOS';
    protected  $_primary = 'id';

    public function buscar($id){
        $q = $this->find($id);

        if(count($q))
        {
            $cargo = $q[0];
            $dto = new CargoDTO($cargo->id, $cargo->nombre);
            return $dto;
        }
    }

    public function buscarTodos()
    {
        $q = $this->fetchAll();
        $cargos = array();
        foreach ($q as $c){
            $dto = new CargoDTO($c->id, $c->nombre);
            
            $cargos[] = $dto;
        }
        return $cargos;
    }
    
    
    public function insertar($dto)
    {
        $cargo = array();
        $cargo['nombre'] = $dto->nombre;
        try {
            $this->insert($cargo);
            return true;
        }  catch (Exception $e)
        {
            return false;
        }
    }

    public function modificar($dto)
    {
        $cargo = array();
        $cargo['nombre'] = $dto->nombre;

        $where = $this->getAdapter()->quoteInto('id = ?', $dto->id);
        $this->update($cargo, $where);
    }
    
    public function eliminar($id)
    {
        try{
            $where = $this->getAdapter()->quoteInto('id = ?', $id);
            $this->delete($where);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
}
?>