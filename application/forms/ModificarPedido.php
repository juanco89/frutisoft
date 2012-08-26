<?php

class Application_Form_ModificarPedido extends Zend_Form
{

    public function init()
    {
        Zend_Loader::loadClass('ProductoDTO');
        Zend_Loader::loadClass('FincaDTO');
        
        $this->setMethod('post');
        $this->setAction('/gestionar-pedido/modificar');

        // Elementos del form
        
        // Id
        $this->addElement('text', 'id', array(
            'label' => 'Código pedido: ',
            'required' => true,
            'validators' => array(array('digits')),
            'placeholder' => 'Id',
            'readonly' => 'readonly'
        ));

        // Text: Fecha Realización
        $this->addElement('text', 'fechaRealizacion', array(
                'Label' => 'Fecha de realización: ',
                'placeholder' => 'dd/mm/yyyy',
                'readonly' => 'readonly',
                'required' => true,
                'validators' => array()
            )
        );

        $this->addElement('text', 'cantidad', array(
            'label' => 'Cantidad: ',
            'required' => true,
            'validators' => array(
                array('float', false, array())
            ),
            'placeholder' => 'Cantidad'
        ));

        $prodDao = new Application_Model_ProductoDAO();
        $datosProd = array();
        foreach ($prodDao->buscarTodos() as $p)
        {
            $datosProd[ $p->id ] = $p->nombre;
        }
        $producto = new Zend_Form_Element_Select('producto');
        $producto->addMultiOptions($datosProd)
                ->setLabel('Producto: ')
                ->setRequired()
                ->addValidators(array(
                    array('InArray',
                            false,
                            array(array_keys($datosProd)))
                ));
        $this->addElement($producto);

        $fincaDao = new Application_Model_FincaDAO();
        $datosFincas = array();
        foreach ($fincaDao->buscarTodos() as $f)
        {
            $datosFincas[ $f->id ] = $f->nombre;
        }
        $finca = new Zend_Form_Element_Select('finca');
        $finca->addMultiOptions($datosFincas)
                ->setRequired()
                ->setLabel('Finca: ')
                ->addValidators(array(
                    array('InArray',
                         false,
                         array(array_keys($datosFincas)))
                ));
        $this->addElement($finca);

        $this->addElement(new ZendX_JQuery_Form_Element_DatePicker('fechaEsperada',
            array('jQueryParams' => array(
                        'dateFormat' => 'dd/mm/yy',
                        'changeMonth'=> true,
			'changeYear' => true 
                        ),
                'Label' => 'Fecha Esperada: ',
                'placeholder' => 'dd/mm/yyyy',
                'required' => true,
                'validators' => array(
                    array('date', false, array('format' => 'dd/mm/yyyy')))
            )
        ));

        $this->addElement('submit', 'Actualizar', array(
            'class' => 'boton'
            ));
    }

}
