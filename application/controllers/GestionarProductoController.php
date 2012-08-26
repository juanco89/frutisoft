<?php

class GestionarProductoController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Loader::loadClass('ProductoDTO');
        $this->view->placeholder('titulo')->set("Productos");
    }

    public function indexAction()
    {
        $dao = new Application_Model_ProductoDAO();
        $productos = $dao->buscarTodos();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginador/paginador.php');
        $paginador = Zend_Paginator::factory($productos);
        $paginador->setItemCountPerPage(5);
        
        if($this->_hasParam('page'))
        {
            $paginador->setCurrentPageNumber($this->_getParam('page'));
        }
        
        $this->view->paginador = $paginador;
    }

    public function nuevoAction()
    {
        $form = new Application_Form_NuevoProducto();
        // Si llegan datos por post el formulario fue enviado.
        if($this->getRequest()->isPost())
        {
            // Se validan los datos del formulario según los validators agregados.
            if($form->isValid($this->_getAllParams()))
            {
                $datos = $form->getValues();

                $dto = new ProductoDTO(0, $datos['nombre']);

                // Creación del dao
                $dao = new Application_Model_ProductoDAO();
                $dao->insertar($dto);

                $this->_redirect('/gestionar-producto/index');
            }
        }

        $this->view->form = $form;
    }

    public function modificarAction()
    {
        $form = new Application_Form_ModificarProducto();

        if($this->getRequest()->isPost())
        {
            // Se envían los datos modificados.
            if($form->isValid($this->_getAllParams()))
            {
                $datos = $form->getValues();
                // Se crea el dto. El id debe ser el mismo.
                $dto = new ProductoDTO($datos['id'], $datos['nombre']);

                // Creación del dao
                $dao = new Application_Model_ProductoDAO();
                // El id no se modifica en el dao
                $dao->modificar($dto);

                $this->_redirect('/gestionar-producto/index');
            }
        }else
        {
            // Se inrgesa al form por primera vez
            if($this->_hasParam('id'))
            {
                // Se busca el dto y se envía a la vista
                $dao = new Application_Model_ProductoDAO();
                $dto = $dao->buscar($this->_getParam('id'));
                $this->view->dto = $dto;
            }
        }
        
        $this->view->form = $form;
    }
    
    public function eliminarAction()
    {
        // Es necesario el parámetro id
        if($this->_hasParam('id')){
            $dao = new Application_Model_ProductoDAO();
            $dao->eliminar($this->_getParam('id'));
        }
        $this->_redirect('/gestionar-producto/index');
    }

}