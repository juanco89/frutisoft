<?php

class GestionarPedidoController extends Zend_Controller_Action
{

    public function init()
    {
        Zend_Loader::loadClass('PedidoDTO');
        $this->view->placeholder('titulo')->set("Pedidos");
    }

    public function indexAction()
    {
        $pedidoDao = new Application_Model_PedidoDAO();        
        $pedidos = $pedidoDao->buscarNoEntregados();
        
        Zend_View_Helper_PaginationControl::setDefaultViewPartial('paginador/paginador.php');
        $paginador = Zend_Paginator::factory($pedidos);
        $paginador->setItemCountPerPage(5);
        
        if($this->_hasParam('page'))
        {
            $paginador->setCurrentPageNumber($this->_getParam('page'));
        }
        
        $this->view->paginador = $paginador;
    }
    
    public function verAction(){
        if($this->_hasParam('id')){
            //Buscar Pedido
            $pedidoDao = new Application_Model_PedidoDAO();
            $pedido = $pedidoDao->buscar($this->_getParam('id'));
            if(isset($pedido)){
                Zend_Loader::loadClass('EstadoPedidoDTO');
                Zend_Loader::loadClass('ProductoDTO');
                Zend_Loader::loadClass('FincaDTO');
                // Buscar otros datos para hacer más entendible la interfaz
                $estadoPedidoDao = new Application_Model_EstadoPedidoDAO();
                $estado = $estadoPedidoDao->buscar($pedido->estado);
                $this->view->estado = $estado;
                
                $productoDAO = new Application_Model_ProductoDAO;
                $producto = $productoDAO->buscar($pedido->producto);
                $this->view->producto = $producto;
                
                $fincaDAO = new Application_Model_FincaDAO();
                $finca = $fincaDAO->buscar($pedido->finca);
                $this->view->finca = $finca;
                
                // Enviar el pedido a la vista
                $this->view->pedido = $pedido;
            }
        }

    }

    public function nuevoAction()
    {
        $form = new Application_Form_NuevoPedido();
        
        if($this->getRequest()->isPost())
        {
            if($form->isValid($this->_getAllParams()))
            {
                $data = $form->getValues();

                $dateArray = Zend_Locale_Format::getDate($data['fechaEsperada'], array('date_format' => 'dd/MM/yyyy'));
                $date  = date("Y-m-d", mktime(0, 0, 0,$dateArray['month'],$dateArray['day'],$dateArray['year']));
                
                // En este caso el id no afecta en nada, pues es autonumérico.
                $dto = new PedidoDTO(0);
                $dto->cantidad = str_replace(',', '.', $data['cantidad']);
                $dto->producto = $data['producto'];
                $dto->finca = $data['finca'];
                $dto->fechaEsperada = $date;

                // Creación del dao
                $dao = new Application_Model_PedidoDAO();
                $dao->insertar($dto);

                $this->_redirect('/gestionar-pedido/index');
            }
        }
        
        $this->view->form = $form;
    }

    public function eliminarAction()
    {
        if($this->_hasParam('id')){
            $dao = new Application_Model_PedidoDAO();
            $dao->eliminar($this->_getParam('id'));
            $this->_redirect('/gestionar-pedido/index');
        }
        $this->_redirect('/gestionar-pedido/index');
    }

    public function modificarAction()
    {
        $form = new Application_Form_ModificarPedido();

        if($this->getRequest()->isPost())
        {
            // Se envió el formulario con los datos para
            if($form->isValid($this->_getAllParams()))
            {
                $data = $form->getValues();

                $dateArray = Zend_Locale_Format::getDate($data['fechaEsperada'], array('date_format' => 'dd/MM/yyyy'));
                $date  = date("Y-m-d", mktime(0, 0, 0,$dateArray['month'],$dateArray['day'],$dateArray['year']));

                // Se guarda el id pero no es actualizado en la base de datos
                $dto = new PedidoDTO($data['id']);
                $dto->cantidad = str_replace(',', '.', $data['cantidad']);
                $dto->producto = $data['producto'];
                $dto->finca = $data['finca'];
                $dto->fechaEsperada = $date;

                // Creación del dao
                $dao = new Application_Model_PedidoDAO();
                $dao->modificar($dto);

                $this->_redirect('/gestionar-pedido/index');
            }
        }        
        if($this->_hasParam('id'))
        {
            // Se ingresó por primera vez al formulario
            // Se busca el dto con el id y se envía a la vista.
            $dao = new Application_Model_PedidoDAO();
            $dto = $dao->buscar($this->_getParam('id'));
            $this->view->dto = $dto;
        }
        $this->view->form = $form;
    }
}

?>

