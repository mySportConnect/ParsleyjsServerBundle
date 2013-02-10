<?php

namespace Parsley\ServerBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\JsonResponse ;
use Symfony\Component\Form\FormRegistryInterface ;

class ValidationController extends Controller
{
    public function validationAction ( $form_service_name , $field_to_compare )
    {

        $response = new JsonResponse ( ) ;

        try
        {
            $this -> get ( 'parsley_server_form_generator' ) -> validateField ( $form_service_name , $field_to_compare ) ;
            $response -> setData ( array (
                'success' => ''
            ) ) ;
        }
        catch (\Exception $e)
        {
            $response -> setData ( array (
                'error' => $e -> getMessage ( )
            ) ) ;
        }

        return $response ;

    }
}

