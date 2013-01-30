<?php

namespace Parsley\ServerBundle\Form;

class UndefinedValidationException extends \Exception
{
}

class Generator 
{
    private $container;

    public __function($container)
    {
        $this->container = $container;
    }

    public function validateField($form_service_name, $field_to_compare)
    {
        
        $form_type = $this->get('form.registry')->getType($form_service_name)->getInnerType();
        $tmp_form = $this->get('form.factory')->create($form_type);

        $config = $this->get('service_container')->getParameter('parsley_server');
        
        try {

            $form = $this->get('form.factory')->createNamed($tmp_form->getName(), $form_type, null, array('validation_groups' =>  $config['validations'][$form_service_name]));
        
        } catch (\Exception $e)
        
        {
            throw new UndefinedValidationException("Please define a form validation for this form.");
        }
        

        $form->bind($this->get('request'));

        $field = $form->get($field_to_compare);
        $errors = array();

        foreach($field->getErrors() as $idx => $error){
                $errors[] =  $this->get('translator')->trans($error->getMessage(), array(), 'validators',  $this->get('request')->getLocale());
        }

        return array($field, $errors);

    }
}
