<?php

class Application_Form_NuevoProducto extends Zend_Form
{

    public function init()
    {
        $this->setMethod('post');
        $this->setAction('/gestionar-producto/nuevo');

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
        
        $this->addElement('submit', 'Guardar', array(
            'class' => 'boton'
        ));
    }


}

