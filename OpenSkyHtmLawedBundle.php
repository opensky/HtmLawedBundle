<?php

namespace OpenSky\Bundle\HtmLawedBundle;

use OpenSky\Bundle\HtmLawedBundle\DependencyInjection\OpenSkyHtmLawedExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OpenSkyHtmLawedBundle extends Bundle
{
    /**
     * @see Symfony\Component\HttpKernel\Bundle.Bundle::build()
     */
    public function build(ContainerBuilder $container)
    {
        $container->registerExtension(new OpenSkyHtmLawedExtension());
    }
}
