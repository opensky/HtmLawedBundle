<?php

namespace OpenSky\Bundle\HtmLawedBundle\Tests\DependencyInjection;

use OpenSky\Bundle\HtmLawedBundle\DependencyInjection\OpenSkyHtmLawedExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\ResolveDefinitionTemplatesPass;

class OpenSkyHtmlLawedExtensionExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldLoadAbstractDefinition()
    {
        $container = new ContainerBuilder();
        $extension = new OpenSkyHtmLawedExtension();

        $config = array(
            'file' => '%kernel.root_dir%/../vendor/htmlawed/htmLawed.php',
        );

        $extension->load(array($config), $container);

        $definitions = $container->getDefinitions();
        $this->assertEquals(1, count($definitions));
        $this->assertTrue($definitions['opensky.htmlawed.abstract']->isAbstract());
    }

    public function testShouldCreateDefinitionsThatExtendAbstractDefinition()
    {
        $container = new ContainerBuilder();
        $extension = new OpenSkyHtmLawedExtension();

        $config = array(
            'file' => '%kernel.root_dir%/../vendor/htmlawed/htmLawed.php',
            'profiles' => array(
                'custom' => array(
                    'config' => array('comment' => 0, 'cdata' => 1),
                    'spec' => 'a=title',
                ),
                'default' => null,
            ),
        );

        $extension->load(array($config), $container);

        $this->compileContainer($container);

        $definitions = $container->getDefinitions();
        $this->assertEquals(3, count($definitions));

        $arguments = $definitions['htmlawed.custom']->getArguments();
        $this->assertEquals($config['profiles']['custom']['config'], $arguments[0]);
        $this->assertEquals($config['profiles']['custom']['spec'], $arguments[1]);

        $arguments = $definitions['htmlawed.default']->getArguments();
        $this->assertEquals(array(), $arguments[0]);
        $this->assertEquals('', $arguments[1]);
    }

    private function compileContainer(ContainerBuilder $container)
    {
        $container->setParameter('kernel.root_dir', __DIR__);
        $container->getCompilerPassConfig()->setOptimizationPasses(array(
            new ResolveDefinitionTemplatesPass(),
        ));
        $container->getCompilerPassConfig()->setRemovingPasses(array());
        $container->compile();
    }
}
