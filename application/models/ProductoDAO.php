<?php

class Application_Model_ProductoDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'PRODUCTOS';
    protected  $_primary = 'id';

    public function buscar($id){
        $q = $this->find($id);

        if(count($q)) 
        {
            $producto = $q[0];
            $dto = new ProductoDTO($producto->id, $producto->nombre);
            return $dto;
        }
    }

    public function buscarTodos()
    {
        $q = $this->fetchAll();
        $productos = array();
        foreach ($q as $p){
            $dto = new ProductoDTO($p->id, $p->nombre);
            
            $productos[] = $dto;
        }
        return $productos;
    }
    
    
    public function insertar($dto)
    {
        $producto = array();
        $producto['nombre'] = $dto->nombre;
        try {
            $this->insert($producto);
            return true;
        }  catch (Exception $e)
        {
            return false;
        }
    }

    public function modificar($dto)
    {
        $producto = array();
        $producto['nombre'] = $dto->nombre;

        $where = $this->getAdapter()->quoteInto('id = ?', $dto->id);
        $this->update($producto, $where);
    }

    public function eliminar($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        try{
            return $this->delete($where);
        }  catch (Exception $e){
            return false;
        }
    }
}
?>