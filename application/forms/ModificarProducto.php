<?php

class Application_Form_ModificarProducto extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/gestionar-producto/modificar');

        $this->addElement('text', 'id', array(
            'label' => 'Código del producto: ',
            'required' => true,
            'readonly'=> 'readonly',
            'validators' => array(
                array('digits', false, array() )
            ),
            'placeholder' => 'Id Producto'
        ));

        $this->addElement('text', 'nombre', array(
            'label' => 'Nombre del producto: ',
            'required' => true,
            'validators' => array(
                array('alnum', false, array(
                    'allowWhiteSpace' => true
                ))
            ),
            'placeholder' => 'Nombre del producto'
        ));
        
        $this->addElement('submit', 'Actualizar', array(
            'class' => 'boton'
        ));
    }


}

