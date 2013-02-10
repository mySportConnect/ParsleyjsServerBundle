<?php

namespace Parsley\ServerBundle\Form ;

class UndefinedValidationException extends \Exception
{
}

class Generator
{
    private $container ;

    public function __construct ( $container )
    {
        $this -> container = $container ;
    }

    public function validateField ( $form_service_name , $field_to_compare )
    {

        $form_type = $this -> container -> get ( 'form.registry' ) -> getType ( $form_service_name ) -> getInnerType ( ) ;
        $tmp_form = $this -> container -> get ( 'form.factory' ) -> create ( $form_type ) ;

        $config = $this -> container -> getParameter ( 'parsley_server' ) ;

        try
        {
            $form = $this -> container -> get ( 'form.factory' ) -> createNamed ( $tmp_form -> getName ( ) , $form_type , null , array ( 'validation_groups' => $config [ 'validations' ] [ $form_service_name ] [ 'group' ] ) ) ;
        }
        catch ( \Exception $e )
        {
            throw new UndefinedValidationException ( 'Please define a form validation for this form.' ) ;
        }

        $form -> bind ( $this -> container -> get ( 'request' ) ) ;
        $field = $form -> get ( $field_to_compare ) ;

        $errorsList = '' ;
        foreach ( $field -> getErrors ( ) as $idx => $error )
        {
            $errorsList .= $this -> container -> get ( 'translator' ) -> trans ( $error -> getMessage ( ) , array ( ) , $config [ 'validations' ] [ $form_service_name ] [ 'translation_domain' ] , $this -> container -> get ( 'request' ) -> getLocale ( ) ) ;
        }
        if ( $errorsList != '' )
        {
            throw new \Exception ( $errorsList ) ;
        }

    }
}
