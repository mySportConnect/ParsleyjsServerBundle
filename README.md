# ParlseyjsServerBundle

A symfony 2 bundle integration of wonderful client-side javascript library [Parsley.js](https://github.com/guillaumepotier/Parsley.js) by @guillaumepotier.

The ParsleyjsServerBundle allows to get Symfony 2 form server-side validation on a field type via form validations.

It uses the data-remote attribute of client-side Parsley.js library. For more informations see [here](http://parsleyjs.org/documentation.html#basic-constraints).

Add ParsleyJsServerBundle to your project:

```bash
$ php composer.phar require mysportconnect/parsley-server-bundle
$ php composer.phar update
```

Add the bundle to your AppKernel.php file:

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // Your bundles
            new Parsley\ServerBundle\ParsleyServerBundle()
        );

```

Add configuration to your config.yml file. As ParsleyJsServerBundle depends on your form validations, not your entities, you must provide information on each form there is a field you want to "remote-validate". You doing this by providing validation_groups for your forms:

```yaml
parsley_server:
    validations:
        fos_user_registration: { group: [Registration], translation_domain: validators}
        fos_user_profile: { group: [Profile], translation_domain: validators}
```

Then add routing information to your routing.yml file:

```yaml
parsley:
    resource: "@ParsleyServerBundle/Resources/config/routing.yml"
    prefix: /parsley
```

Finally enable Parsley validation on the field you want to like this:

```php
    public function buildForm ( FormBuilderInterface $builder , array $options )
    {
        $builder
            -> add ( 'username' , null , array (
                                        "parsley" => true
            ) )
    }
```

## News

IRC on irc.freenode.net #mysportconnect

## License

ParsleyjsServerBundle is licensed under the MIT license (see LICENSE.md file).

## Author

mySportConnect, Alain Bangoula (aka comensee), Rémi Barbe (aka Remiii) and contributors.

## Bug report and Help

For bug reports open a Github ticket. Patches gratefully accepted. :-)

