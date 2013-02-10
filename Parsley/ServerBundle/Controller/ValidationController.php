<?php

namespace Parsley\ServerBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\Form\FormRegistryInterface ;

class ValidationController extends Controller
{
    public function validationAction ( $form_service_name , $field_to_compare )
    {

        list ( $field , $errors ) = $this -> get ( 'parsley_server_form_generator' ) -> validateField ( $form_service_name , $field_to_compare ) ;

        $response = new JsonResponse ( ) ;

        if ( count ( $errors ) == 0 )
        {
            $response -> setData ( array (
                'success' => ''
            ) ) ;
        }
        else
        {
            $message = '' ;
            foreach ( $errors as $error )
            {
                $message .= $error ;
            }
            $response -> setData ( array (
                'error' => $message
            ) ) ;
        }
        return $response ;

    }
}

