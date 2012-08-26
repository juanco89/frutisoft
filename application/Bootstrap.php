<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initViewParams() {
        //Iniciarlizar el objeto view
        $this->bootstrap('view');
        $view = $this->getResource('view');

        $view->setEncoding('utf-8');
        $view->placeholder('titulo')->set("Index");
        $view->doctype('HTML5');
        $view->headLink()->appendStylesheet('/css/estilo-global.css');

        // JQuery
        //$view->headLink()->appendStylesheet('/css/south-street/jquery-ui-1.8.22.custom.css');
        //$view->headScript()->appendFile('/js/jquery/jquery-1.7.2.min.js');
        //$view->headScript()->appendFile('/js/jquery/jquery-ui-1.8.22.custom.min.js');

        $view->addHelperPath("ZendX/JQuery/View/Helper", "ZendX_JQuery_View_Helper");
        $view->jQuery()->addStylesheet('/css/south-street/jquery-ui-1.8.22.custom.css')
            ->setLocalPath('/js/jquery/jquery-1.7.2.min.js')
            ->setUiLocalPath('/js/jquery/jquery-ui-1.8.22.custom.min.js');

        $view->jQuery()->enable();
        $view->jQuery()->uiEnable();
    }

    protected function _initTranslationErrorMessages()
    {
        $translateValidators = array(
                Zend_Validate_NotEmpty::IS_EMPTY => 'Este dato es requerido.',
                Zend_Validate_Regex::NOT_MATCH => 'Este valor no concuerda.',
                Zend_Validate_EmailAddress::INVALID => 'E-mail no válido.',
                Zend_Validate_Float::NOT_FLOAT => 'Debe ingresar un valor numérico. Use coma (,) para separa la parte decimal.',
                Zend_Validate_InArray::NOT_IN_ARRAY => 'El valor seleccionado debe estar en la lista.',
                Zend_Validate_Digits::NOT_DIGITS => 'Este dato debe ser numérico',
                Zend_Validate_Date::INVALID_DATE => 'La fecha es inválida',
                Zend_Validate_Date::FALSEFORMAT => 'El formato usado debe ser "dd/mm/yyyy".',
                Zend_Validate_Alnum::NOT_ALNUM => 'Solo se permiten letras y dígitos.',
                Zend_Validate_EmailAddress::INVALID_HOSTNAME => 'No se logra reconocer el servidor.',
                Zend_Validate_EmailAddress::INVALID_FORMAT => 'Formato del email no váildo.',
                Zend_Validate_EmailAddress::INVALID => 'Email no válido.'
        );
        $translator = new Zend_Translate('array', $translateValidators);
        Zend_Validate_Abstract::setDefaultTranslator($translator);
    }
}

?>