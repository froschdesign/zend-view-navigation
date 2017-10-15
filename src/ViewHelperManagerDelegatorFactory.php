<?php
/**
 * @see       https://github.com/zendframework/zend-view-navigation for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-view-navigation/blob/master/LICENSE.md New BSD License
 */

namespace Zend\View\Navigation;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

/**
 * Inject the zend-view HelperManager with zend-navigation view helper
 * configuration.
 *
 * The HelperConfig class performs work to ensure that the navigation helper and
 * all its sub-helpers are injected with the view helper manager and application
 * container.
 */
class ViewHelperManagerDelegatorFactory implements DelegatorFactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return \Zend\View\Navigation\Helper\PluginManager
     */
    public function __invoke(
        ContainerInterface $container,
        $name,
        callable $callback,
        array $options = null
    ) {
        $viewHelpers = $callback();
        (new HelperConfig())->configureServiceManager($viewHelpers);

        return $viewHelpers;
    }
}
