<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('ttskch_user');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->scalarNode('some_parameter')
                    ->info('some explanations')
                    ->defaultValue('default value')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
