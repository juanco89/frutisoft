<?php

class Application_Form_NuevaFinca extends Zend_Form
{

    public function init()
    {
        Zend_Loader::loadClass('EmpleadoDTO');

        $this->setMethod('post');
        $this->setAction('/gestionar-finca/nueva');

        // Nombre Finca
        $this->addElement('text', 'nombre', array(
            'label' => 'Nombre: ',
            'required' => true,
            'validators' => array(
                array('alnum', false, array(
                    'allowWhiteSpace' => true
                ))
            ),
            'placeholder' => 'Nombre de la finca'
        ));

        // Ubicación
        $this->addElement('text', 'ubicacion', array(
            'label' => 'Ubicación: ',
            'required' => true,
            'validators' => array(
                array('alnum', false, array(
                    'allowWhiteSpace' => true
                ))
            ),
            'placeholder' => 'Ubicación'
        ));

        // Telefono
        $this->addElement('text', 'telefono', array(
            'label' => 'Teléfono: ',
            'required' => false,
            'validators' => array(
                array('digits', false, array( ))
            ),
            'placeholder' => 'Teléfono'
        ));

        // Número de hectáreas
        $this->addElement('text', 'hectareas', array(
            'label' => 'Número de hectáreas ',
            'required' => true,
            'validators' => array(
                array('digits', false, array())
            ),
            'placeholder' => 'Número de hectáreas'
        ));

        // Administrador de la finca.
        $dao = new Application_Model_EmpleadoDAO();
        $arrayAdmins = array(
            -1 => '(Ninguno)'
        );
        foreach ($dao->buscarAdministradores() as $adm)
        {
            $arrayAdmins[ $adm->identificacion ] = $adm->nombre;
        }
        $admin = new Zend_Form_Element_Select('administrador');
        $admin->addMultiOptions($arrayAdmins)
                ->setLabel('Administrador: ')
                ->setRequired()
                ->addValidators(array(
                    array('InArray',
                            false,
                            array(array_keys($arrayAdmins)))
                ));
        $this->addElement($admin);

        // Submit
        $this->addElement('submit', 'Guardar', array(
            'class' => 'boton'
        ));
    }
}

