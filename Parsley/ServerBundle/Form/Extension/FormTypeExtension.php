<?php

namespace Parsley\ServerBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FormTypeExtension extends AbstractTypeExtension
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->setAttribute('parsley', $options['parsley']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if($options['parsley']){
            $view->vars = array_replace($view->vars, array(
                'attr'              => array(
                    "data-remote" => $this->container->get("router")->generate('parsley_validation',
                        array("form_service_name"=>$parentFullName, "field_to_compare"=>$name))
                )
            ));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'parsley' => false,
        ));
    }

    public function getExtendedType()
    {
        return 'form';
    }
}
