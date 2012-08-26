<?php

class GestionarFincaController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Loader::loadClass('FincaDTO');
        $this->view->placeholder('titulo')->set("Fincas");
    }

    public function indexAction()
    {
        $dao = new Application_Model_FincaDAO();
        $fincas = $dao->buscarTodos();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginador/paginador.php');
        $paginador = Zend_Paginator::factory($fincas);
        $paginador->setItemCountPerPage(5);

        if($this->_hasParam('page'))
        {
            $paginador->setCurrentPageNumber($this->_getParam('page'));
        }
        
        $this->view->paginador = $paginador;
    }

    public function nuevaAction()
    {
        $form = new Application_Form_NuevaFinca();
        // Si llegan datos por post el formulario fue enviado.
        if($this->getRequest()->isPost())
        {
            // Se validan los datos del formulario según los validators agregados.
            if($form->isValid($this->_getAllParams()))
            {
                $datos = $form->getValues();

                $dto = new FincaDTO(0, $datos['nombre'], $datos['hectareas']);
                $dto->telefono = $datos['telefono'];
                $dto->ubicacion = $datos['ubicacion'];                
                $dto->administrador = ($datos['administrador'] == -1)? NULL:$datos['administrador'];

                // Creación del dao
                $dao = new Application_Model_FincaDAO();
                $dao->insertar($dto);

                $this->_redirect('/gestionar-finca/index');
            }
        }

        $this->view->form = $form;
    }

}

