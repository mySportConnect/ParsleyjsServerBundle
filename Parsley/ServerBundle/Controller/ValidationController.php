<?php

namespace Parsley\ServerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormRegistryInterface ;

class ValidationController extends Controller
{
    public function validationAction($form_service_name, $field_to_compare)
    {
        
        list($field, $errors) = $this->get('parsley_server_form_generator')->validateField($form_service_name, $field_to_compare);

        if(count($errors) == 0){
            $response = new Response(1);
            return $response;
        } else {
            $message = "";
            foreach($errors as $error){
                $message .= $error;
            }
            $response = new JsonResponse();
            $response->setData(array(
                'error' => $message
            ));
            return $response;
        }
    }
}

