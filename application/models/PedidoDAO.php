<?php

class Application_Model_PedidoDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'PEDIDOS';
    protected  $_primary = 'id';

    public function buscarNoEntregados() {
        $query = $this->fetchAll(
                $this->select()
                ->where('fecha_entrega IS NULL')
                );
        $pedidos = array();
        foreach ($query as $p)
        {
            $dto = new PedidoDTO($p->id);
            $dto->cantidad = $p->cantidad;
            $dto->fechaRealizacion = $p->fecha_realizacion;
            $dto->fechaEsperada = $p->fecha_esperada;
            $dto->fechaEntrega = $p->fecha_entrega;
            $dto->estado = $p->estado;
            $dto->producto = $p->producto;
            $dto->finca = $p->finca;
            
            $pedidos[] = $dto;
        }
        return $pedidos;
    }   

    public function buscar($id){
        $pedido = $this->find($id);
        if(count($pedido))
        {
            $dto = new PedidoDTO($pedido[0]->id);
            $dto->cantidad = $pedido[0]->cantidad;
            $dto->fechaRealizacion = $pedido[0]->fecha_realizacion;
            $dto->fechaEsperada = $pedido[0]->fecha_esperada;
            $dto->fechaEntrega = $pedido[0]->fecha_entrega;
            $dto->estado = $pedido[0]->estado;
            $dto->producto = $pedido[0]->producto;
            $dto->finca = $pedido[0]->finca;
            return $dto;
        }
    }
    
    public function insertar($dto)
    {
        $pedido = array();
        $pedido['cantidad'] = $dto->cantidad;
        $pedido['fecha_esperada'] = $dto->fechaEsperada;
        $pedido['producto'] = $dto->producto;
        $pedido['finca'] = $dto->finca;
        try {
            $this->insert($pedido);
            return true;
        }  catch (Exception $e) {
            return false;
        }
    }

    public function modificar($dto)
    {
        $pedido = array();
        $pedido['cantidad'] = $dto->cantidad;
        $pedido['fecha_esperada'] = $dto->fechaEsperada;
        $pedido['producto'] = $dto->producto;
        $pedido['finca'] = $dto->finca;
        //$pedido['fecha_entrega'] = $dto->fechaEntrega;
        //$pedido['estado'] = $dto->estado;

        $where = $this->getAdapter()->quoteInto('id = ?', $dto->id);
        $this->update($pedido, $where);
    }

    public function eliminar($id)
    {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->delete($where);
    }
}

?>
