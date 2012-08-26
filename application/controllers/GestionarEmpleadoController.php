<?php

class GestionarEmpleadoController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Loader::loadClass('EmpleadoDTO');
        $this->view->placeholder('titulo')->set("Empleados");
    }

    public function indexAction()
    {
        $dao = new Application_Model_EmpleadoDAO();        
        $empleados = $dao->buscarTodos();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginador/paginador.php');
        $paginador = Zend_Paginator::factory($empleados);
        $paginador->setItemCountPerPage(5);
        
        if($this->_hasParam('page'))
        {
            $paginador->setCurrentPageNumber($this->_getParam('page'));
        }
        
        $this->view->paginador = $paginador;
    }
    
    public function verAction(){
        if($this->_hasParam('id')){
            //Buscar Empleado
            $empleadoDao = new Application_Model_EmpleadoDAO();
            $empleado = $empleadoDao->buscar($this->_getParam('id'));
            if(isset($empleado)){
                Zend_Loader::loadClass('CargoDTO');
                // Buscar otros datos para hacer más entendible la interfaz
                $cargoDao = new Application_Model_CargoDAO();
                $cargo = $cargoDao->buscar($empleado->cargo);
                $this->view->cargo = $cargo;
                
                // Enviar el empleado a la vista
                $this->view->empleado = $empleado;
            }
        }

    }

    public function nuevoAction()
    {
        $form = new Application_Form_NuevoEmpleado();
        if($this->getRequest()->isPost())
        {
            if($form->isValid($this->_getAllParams()))
            {
                $data = $form->getValues();
                $dto = new EmpleadoDTO($data['identificacion']);
                $dto->nombre = $data['nombre'];
                $dto->salario = str_replace(',', '.',$data['salario']);
                $dto->email = $data['email'];
                $dto->telefono = $data['telefono'];
                $dto->cargo = $data['cargo'];

                // Creación del dao
                $dao = new Application_Model_EmpleadoDAO();
                $dao->insertar($dto);

                $this->_redirect('/gestionar-empleado/index');
            }
        }
        $this->view->form = $form;
    }
    
    public function eliminarAction()
    {
        if($this->_hasParam('id')){
            $dao = new Application_Model_EmpleadoDAO();
            $dao->eliminar($this->_getParam('id'));
            $this->_redirect('/gestionar-empleado/index');
        }
        $this->_redirect('/gestionar-empleado/index');
    }
    
   public function modificarAction()
    {
       // Se instancia el form
        $form = new Application_Form_ModificarEmpleado();
        $this->view->form = $form;
        
        if($this->_hasParam('id')){
            // Llegaron los datos por primera vez
            // Se busca el empleado y se 'settea' en la vista
            $dao = new Application_Model_EmpleadoDAO();
            $e = $dao->buscar($this->_getParam('id'));
            $dto = array();
            if(isset($dto)){
                $dto['identificacion'] = $e->identificacion;
                $dto['nombre'] = $e->nombre;
                $dto['salario'] = str_replace('.', ',',$e->salario);
                $dto['email'] = $e->email;
                $dto['telefono'] = $e->telefono;
                $dto['cargo'] = $e->cargo;
            }
            // Se le dice a la vista que le ponga estos datos a los campos
            $form->populate($dto);
        }
        elseif($this->getRequest()->isPost())
        {
            // Se envian los datos ya modificados
            if($form->isValid($this->_getAllParams()))
            {
                $data = $form->getValues();
                $dto = new EmpleadoDTO($data['identificacion']);
                $dto->nombre = $data['nombre'];
                $dto->salario = str_replace(',', '.',$data['salario']);
                $dto->email = $data['email'];
                $dto->telefono = $data['telefono'];
                $dto->cargo = $data['cargo'];
                // Creación del dao
                $dao = new Application_Model_EmpleadoDAO();
                $dao->modificar($dto);
                $this->_redirect('/gestionar-empleado/index');
            }
            //$this->view->form = $form;
        }else {
            $this->_redirect('/gestionar-empleado/index');
        }
    }
}

?>

