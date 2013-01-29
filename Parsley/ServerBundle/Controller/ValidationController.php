<?php

namespace Parsley\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\Form\FormRegistryInterface ;

class ValidationController extends Controller
{
    public function validationAction($form_service_name, $field_to_compare)
    {
        $form_type = $this->get('form.registry')->getType($form_service_name)->getInnerType();
        $tmp_form = $this->get('form.factory')->create($form_type);

        $config = $this->get('service_container')->getParameter('parsley_server');

        $form = $this->get('form.factory')->createNamed($tmp_form->getName(), $form_type, null, array('validation_groups' =>  $config['validations'][$form_service_name]));

        $form->bind($this->get('request'));

        $field = $form->get($field_to_compare);
        $errors = array();

        foreach($field->getErrors() as $idx => $error){
                $errors[] =  $this->get('translator')->trans($error->getMessage(), array(), 'validators',  $this->get('request')->getLocale());
        }

        if(count($errors) == 0){
            $response = new Response(1);
            return $response;
        } else {
            $message = "";
            foreach($errors as $error){
                $message .= $error;
            }
            $response = new Response($message);
            $response->setStatusCode(500);
            return $response;
        }
    }
}
