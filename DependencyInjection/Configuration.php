<?php

namespace OpenSky\Bundle\HtmLawedBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration
{
    /**
     * Generates the configuration tree.
     *
     * @return Symfony\Component\Config\Definition\NodeInterface
     */
    public function getConfigTree()
    {
        $treeBuilder = new TreeBuilder();

        return $treeBuilder
            ->root('opensky_htmlawed', 'array')
                //->children()
                    ->scalarNode('file')->isRequired()->cannotBeEmpty()->end()
                    ->arrayNode('profiles')
                        ->useAttributeAsKey('id')
                        ->prototype('array')
                            //->children()
                                // TODO: Add htmLawed configuration structure
                                ->variableNode('config')
                                    ->defaultValue(array())
                                    ->beforeNormalization()
                                        ->ifTrue(function($v){ return !is_array($v); })
                                        ->thenEmptyArray()
                                    ->end()
                                ->end()
                                ->scalarNode('spec')->defaultNull()->end()
                            //->end()
                        ->end()
                    ->end()
                //->end()
            ->end()
            ->buildTree()
        ;
    }
}
