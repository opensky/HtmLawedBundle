# HtmLawedBundle

This bundle wraps the [htmLawed](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/)
library as a Symfony2 service. Ultimately, it will provide form fields to easily
sanitize user input.

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
when filtering a string.

The `file` option should be set with the path to the htmLawed vendor library.
The service container will ensure this file resource is loaded before one of the
configured services is constructed.

See also:

 * [htmLawed documentation](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/htmLawed_README.htm)
