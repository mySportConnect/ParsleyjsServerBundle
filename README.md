ParlseyJsServerBundle
===================

The ParsleyJsServerBundle allows to get Symfony 2 form server-side validation on a field type via form validations.

It uses the data-remote attribute of client-side Parsley.js library.


Add ParsleyJsServerBundle to your project : 

```
php composer.phar require mysportconnect/parsley-server-bundle
php composer.phar update
```

Add the bundle to your AppKernel.php file : 

```
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            //your bundles
            new Parsley\ServerBundle\ParsleyServerBundle()
        );

```

Add configuration to your config.yml file. As ParsleyJsServerBundle depends on your form validations, not your entities, you must provide information on each form there is a field you want to "remote-validate". You doing this by providing validation_groups for your forms  : 

```
parsley_server:
    validations:
        fos_user_registration: [Registration]
        fos_user_profile: [Profile]
```

Then add routing information to your routing.yml file : 

```
parsley:
    resource: "@ParsleyServerBundle/Resources/config/routing.yml"
    prefix: /parsley
```

Finally enable Parsley validation on the field you want to like this : 

```
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, array(
                                        "parsley" => true
            ))
    }
```


