<?php

class Application_Form_NuevoEmpleado extends Zend_Form
{

    public function init()
    {
        Zend_Loader::loadClass('CargoDTO');
        
        $this->setMethod('post');
        $this->setAction('/gestionar-empleado/nuevo');

        $this->addElement('text', 'identificacion', array(
            'label' => 'Identificacion: ',
            'required' => true,
            'validators' => array(
                array('digits', false, array())
            ),
            'placeholder' => 'Identificación'
        ));

        $this->addElement('text', 'nombre', array(
            'label' => 'Nombre: ',
            'required' => true,
            'validators' => array(
                array('alpha', false, array('allowWhiteSpace' => true))
            ),
            'placeholder' => 'Nombre'
        ));

        $this->addElement('text', 'salario', array(
            'label' => 'Salario: ',
            'required' => true,
            'validators' => array(
                array('float', false, array())
            ),
            'placeholder' => 'Salario'
        ));

        $this->addElement('text', 'email', array(
            'label' => 'Email: ',
            'required' => false,
            'validators' => array(
                array('EmailAddress', false, array( ))
            ),
            'placeholder' => 'Email'
        ));
   
        $this->addElement('text', 'telefono', array(
            'label' => 'Teléfono: ',
            'required' => false,
            'validators' => array(
                array('digits', false, array())
            ),
            'placeholder' => 'Teléfono'
        ));
        
        $dao = new Application_Model_CargoDAO();
        $arrayCargo = array();
        foreach ($dao->buscarTodos() as $c)
        {
            $arrayCargo[ $c->id ] = $c->nombre;
        }
        $cargo = new Zend_Form_Element_Select('cargo');
        $cargo->addMultiOptions($arrayCargo)
                ->setLabel('Cargo: ')
                ->setRequired()
                ->addValidators(array(
                    array('InArray',
                            false,
                            array(array_keys($arrayCargo)))
                ));
        $this->addElement($cargo);
        
        
        $this->addElement('submit', 'Enviar', array(
            'class' => 'boton'
            ));
    }

}