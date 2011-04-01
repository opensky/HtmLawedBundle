# HtmLawedBundle

This bundle integrates [htmLawed][1] with Symfony2. It allows you to define
htmLawed configuration profiles, which are exposed as services implementing
`ValueTransformerInterface`. These transformers can easily be attached to form
fields for input sanitization.

## Installation

### Submodule Creation

Add HtmLawedBundle to your `src/` directory:

    $ git submodule add git://github.com/opensky/HtmLawedBundle.git src/OpenSky/Bundle/HtmLawedBundle

### Class Autoloading

If the `src/` directory is already configured in your project's `autoload.php`
via `registerNamespaceFallback()`, no changes should be necessary.  Otherwise,
either define the fallback directory or explicitly add the "OpenSky" namespace:

    # src/autoload.php

    $loader->registerNamespaces(array(
        'OpenSky' => __DIR__,
    ));

### Application Kernel

Add HtmLawedBundle to the `registerBundles()` method of your application kernel:

    public function registerBundles()
    {
        return array(
            new OpenSky\Bundle\HtmLawedBundle\OpenSkyHtmLawedBundle(),
        );
    }

## Configuration

This bundle defines an `HtmLawed` service, which is constructed with `$config`
and `$spec` parameters. It implements a single `process()` method that filters a
string value through the `htmLawed()` function. The `$config` and `$spec`
parameters provided during construction will be passed to `htmLawed()`.

### HtmLawed Extension

HtmLawedBundle may be configured with the following:

    # app/config/config.yml

    opensky_htmlawed:
        file: %kernel.root_dir%/../vendor/htmlawed/htmLawed.php
        profiles:
            custom:
                config:
                    comment: 0
                    cdata:   1
                spec: a=title
            default: ~

The above example would define two services: `htmlawed.custom` and `htmlawed.default`,
which will use their respective options as additional arguments to `htmLawed()`
when filtering input.

The `file` option should be set with the path to the htmLawed vendor library.
The service container will ensure this file resource is loaded before one of the
configured services is constructed.

See also:

 * [htmLawed documentation][2]

## HtmLawedTransformer

The services created by this bundle implement `ValueTransformerInterface` from
the Symfony2 Form component. Filtering is only done via `transform()`. The
`reverseTransform()` method is an identity function (i.e. it returns its input).

## Using with Form Fields

The htmLawed services should be assigned to form fields as normalization
transformers (not value transformers). The following example demonstrates how
to inject the transformer service into the field through the form object.

    use Symfony\Component\Form\Form;
    use Symfony\Component\Form\TextareaField;

    class MyForm extends Form
    {
        protected function configure()
        {
            $this->addRequiredOption('htmlawed');

            $field = new TextareaField('html', array(
                'normalization_transformer' => $this->getOption('htmlawed')
            ));
        }
    }

    $form = new MyForm('my_form', array(
        'htmlawed' => $container->get('htmlawed.custom');
    ));

  [1]: http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/
  [2]: http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/htmLawed_README.htm
