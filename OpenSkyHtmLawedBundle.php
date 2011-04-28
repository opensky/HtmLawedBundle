<?php

namespace OpenSky\Bundle\HtmLawedBundle;

use OpenSky\Bundle\HtmLawedBundle\DependencyInjection\OpenSkyHtmLawedExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class OpenSkyHtmLawedBundle extends Bundle
{
    public function __construct()
    {
        $this->extension = new OpenSkyHtmLawedExtension();
    }
}
