<?php
/**
 * @see       https://github.com/zendframework/zend-view-navigation for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-view-navigation/blob/master/LICENSE.md New BSD License
 */

namespace Helper\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\View\Navigation\Helper\Navigation as NavigationHelper;
use Zend\View\Navigation\Helper\Factory\NavigationHelperFactory;
use PHPUnit\Framework\TestCase;

class NavigationHelperFactoryTest extends TestCase
{
    /**
     * @var NavigationHelperFactory
     */
    private $factory;

    /**
     * @var ContainerInterface
     */
    private $container;

    protected function setUp()
    {
        $this->factory   = new NavigationHelperFactory();
        $this->container = new ServiceManager();
    }

    public function testFactoryShouldReturnNavigationHelper()
    {
        $helper = ($this->factory)($this->container, 'test');

        $this->assertInstanceOf(NavigationHelper::class, $helper);
    }

    public function testFactoryShouldInjectContainer()
    {
        /** @var NavigationHelper $helper */
        $helper = ($this->factory)($this->container, 'test');

        $this->assertSame($this->container, $helper->getNavigationManager());
    }
}
