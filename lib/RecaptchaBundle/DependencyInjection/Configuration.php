<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 10/05/2019
 * Time: 11:25
 */

namespace Mig\RecaptchaBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('recaptcha');
        $rootNode
            ->children()
            ->scalarNode('key')
            ->isRequired()
            ->cannotBeEmpty()
            ->end()
            ->scalarNode('secret')
            ->cannotBeEmpty()
            ->isRequired()
            ->end()
            ->end();
        return $treeBuilder;


    }
}