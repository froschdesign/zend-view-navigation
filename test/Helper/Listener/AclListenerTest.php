<?php
/**
 * @see       https://github.com/zendframework/zend-view-navigation for the canonical source repository
 * @copyright Copyright (c) 2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-view-navigation/blob/master/LICENSE.md New BSD License
 */

namespace Helper\Listener;

use Zend\EventManager\Event;
use Zend\Navigation\Page\AbstractPage;
use Zend\Navigation\Page\Uri;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Resource\GenericResource;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\View\Navigation\Helper\Listener\AclListener;
use PHPUnit\Framework\TestCase;

class AclListenerTest extends TestCase
{
    /**
     * @var AclListener
     */
    private $listener;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var AbstractPage
     */
    private $page;

    /**
     * @var Acl
     */
    private $acl;

    protected function setUp()
    {
        // Page
        $this->page = new Uri(
            [
                'uri'      => '/test',
                'resource' => 'test_resource',
            ]
        );

        // Acl
        $this->acl = new Acl();
        $this->acl->addRole(new GenericRole('admin'));
        $this->acl->addResource(new GenericResource('test_resource'));

        // Listener
        $this->listener = new AclListener();

        // Event
        $this->event = new Event(
            null,
            null,
            [
                'acl'  => $this->acl,
                'page' => $this->page,
                'role' => 'admin',
            ]
        );
    }

    public function testAcceptMethodShouldReturnTrueForAcceptedPage()
    {
        // Allow access to page
        $this->acl->allow('admin', 'test_resource');

        $this->assertTrue($this->listener::accept($this->event));
    }

    public function testAcceptMethodShouldReturnFalseForNotAcceptedPage()
    {
        // Deny access to page
        $this->acl->deny('admin', 'test_resource');

        $this->assertFalse($this->listener::accept($this->event));
    }

    public function testAcceptMethodShouldReturnTrueWithoutAcl()
    {
        $this->event->setParam('acl', null);
        $this->assertTrue($this->listener::accept($this->event));
    }
}
