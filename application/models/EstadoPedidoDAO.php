<?php

class Application_Model_EstadoPedidoDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'ESTADO_PEDIDOS';
    protected  $_primary = 'id';

    public function buscar($id){
        $q = $this->find($id);
        
        if(count($q)) 
        {
            $estado = $q[0];
            $dto = new EstadoPedidoDTO($estado->id, $estado->nombre);
            return $dto;
        }
    }

    public function buscarTodos()
    {
        $q = $this->fetchAll();
        $estados = array();
        foreach ($q as $e){
            $dto = new EstadoPedidoDTO($e->id, $e->nombre);
            
            $estados[] = $dto;
        }
        return $estados;
    }
    
    public function insertar($dto)
    {
        $estado = array();
        $estado['nombre'] = $dto->nombre;
        try {
            $this->insert($estado);
            return true;
        }  catch (Exception $e)
        {
            return false;
        }
    }

    public function modificar($dto)
    {
        $estado = array();
        $estado['nombre'] = $dto->nombre;

        $where = $this->getAdapter()->quoteInto('id = ?', $dto->id);
        $this->update($estado, $where);
    }
    
    public function eliminar($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
    }
}
?>
