<?php
/**
 * @see       https://github.com/zendframework/zend-view-navigation for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-view-navigation/blob/master/LICENSE.md New BSD License
 */

namespace Zend\View\Navigation\Helper\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\View\Navigation\Helper\Navigation as NavigationHelper;

class NavigationHelperFactory implements FactoryInterface
{
    /**
     * {@inheritdoc}
     *
     * @return NavigationHelper
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ) {
        $helper = new NavigationHelper();
        $helper->setNavigationManager($container);

        return $helper;
    }
}
