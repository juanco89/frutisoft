<?php

class Application_Model_EmpleadoDAO extends Zend_Db_Table_Abstract
{
    protected $_name = 'EMPLEADOS';
    protected  $_primary = 'identificacion';

    public function buscarTodos() {
        $query = $this->fetchAll();
        $empleados = array();
        foreach ($query as $e)
        {
            $dto = new EmpleadoDTO($e->identificacion);
            $dto->nombre = $e->nombre;
            $dto->salario = $e->salario;
            $dto->email = $e->email;
            $dto->telefono = $e->telefono;
            $dto->cargo = $e->cargo;
            
            $empleados[] = $dto;
        }
        return $empleados;
    }   

    public function buscarAdministradores() {
        $query = $this->fetchAll(
                $this->select()
                ->setIntegrityCheck(false)
                ->where('cargo = ?', 1) // Cargo 1: Administrador
                );
        $administradores = array();
        foreach ($query as $e)
        {
            $dto = new EmpleadoDTO($e->identificacion);
            $dto->nombre = $e->nombre;
            $dto->salario = $e->salario;
            $dto->email = $e->email;
            $dto->telefono = $e->telefono;
            $dto->cargo = $e->cargo;
            
            $administradores[] = $dto;
        }
        return $administradores;
    }
    
    public function buscar($id){
        $empleado = $this->find($id);
        if(count($empleado))
        {
            $dto = new EmpleadoDTO($empleado[0]->identificacion);
            $dto->nombre = $empleado[0]->nombre;
            $dto->salario = $empleado[0]->salario;
            $dto->email = $empleado[0]->email;
            $dto->telefono = $empleado[0]->telefono;
            $dto->cargo = $empleado[0]->cargo;
            return $dto;
        }
    }

    public function insertar($dto)
    {
        $empleado = array();
        $empleado['identificacion'] = $dto->identificacion;
        $empleado['nombre'] = $dto->nombre;
        $empleado['salario'] = $dto->salario;
        $empleado['email'] = $dto->email;
        $empleado['telefono'] = $dto->telefono;
        $empleado['cargo'] = $dto->cargo;
        try {
            $this->insert($empleado);
            return true;
        }  catch (Exception $e) {
            return false;
        }
    }

    public function modificar($dto)
    {
        $empleado = array();
        $empleado['nombre'] = $dto->nombre;
        $empleado['salario'] = $dto->salario;
        $empleado['email'] = $dto->email;
        $empleado['telefono'] = $dto->telefono;
        $empleado['cargo'] = $dto->cargo;
        $where = $this->getAdapter()->quoteInto('identificacion = ?', $dto->identificacion);
        $this->update($empleado, $where);
    }

    public function eliminar($id)
    {
        $where = $this->getAdapter()->quoteInto('identificacion = ?', $id);
        try{
            $this->delete($where);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }
}

?>