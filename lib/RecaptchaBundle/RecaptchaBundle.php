<?php
/**
 * Created by PhpStorm.
 * User: Seb
 * Date: 10/05/2019
 * Time: 09:05
 */

namespace Mig\RecaptchaBundle;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RecaptchaBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new RecaptchaCompilerPass());
    }
}