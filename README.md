# HtmLawedBundle

This bundle wraps the htmLawed library as a Symfony2 service and provides form
fields.

## Installation

### Dependencies

This bundle depends on [htmLawed](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/).

Since htmLawed is not packaged as a class, it cannot be autoloaded. You should
manually require the library from your project's `autoload.php` file.

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

HtmLawed services may be configured with the following:

    # app/config/config.yml

    opensky_htmlawed:
        custom:
            config:
                comment: 0
                cdata:   1
            spec: a=title
        default: ~

The above example would define two services: `htmlawed.custom` and `htmlawed.default`.
Each service created by the extension is essentially a pre-configured profile
for filtering input using `htmLawed()`.

See also:

 * [htmLawed documentation](http://www.bioinformatics.org/phplabware/internal_utilities/htmLawed/htmLawed_README.htm)
