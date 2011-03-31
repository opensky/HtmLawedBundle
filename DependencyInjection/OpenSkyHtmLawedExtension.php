<?php

namespace OpenSky\Bundle\HtmLawedBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class OpenSkyHtmLawedExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('htmlawed.xml');

        $processor = new Processor();
        $configuration = new Configuration();

        $config = $processor->process($configuration->getConfigTree(), $configs);

        foreach ($config as $id => $value) {
            $this->createHtmLawed($container, $id, $value);
        }
    }

    private function createHtmLawed(ContainerBuilder $container, $id, array $config)
    {
        $serviceId = 'htmlawed.'.$id;

        $container
            ->setDefinition($serviceId, new DefinitionDecorator('opensky.htmlawed.abstract'))
            ->setArgument(0, $config['config'])
            ->setArgument(1, $config['spec'])
        ;
    }

    public function getAlias()
    {
        return 'opensky_htmlawed';
    }
}
