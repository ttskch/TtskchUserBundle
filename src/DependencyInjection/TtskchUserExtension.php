<?php

declare(strict_types=1);

namespace Ttskch\UserBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class TtskchUserExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');
        $loader->load('controllers.yaml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $someDefinition = $container->getDefinition('ttskch_user.some_service');
        $someDefinition->replaceArgument(0, $config['some_parameter']);
    }
}
