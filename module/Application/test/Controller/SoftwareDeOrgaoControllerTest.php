<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace ApplicationTest\Controller;

use Laminas\Stdlib\ArrayUtils;
use Laminas\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class SoftwareDeOrgaoControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp() : void
    {
        // The module configuration should still be applicable for tests.
        // You can override configuration here with test case specific values,
        // such as sample view templates, path stacks, module_listener_options,
        // etc.

        $configOverrides = [];

        $this->setApplicationConfig(ArrayUtils::merge(
            include __DIR__ . '/../../../../config/test.config.php',
            $configOverrides
        ));

        parent::setUp();
    }

    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/software-de-orgao', 'GET');
        $this->assertResponseStatusCode(500);
        $this->assertModuleName('application');
        $this->assertControllerName('software-de-orgao'); // as specified in router's controller name alias
        $this->assertControllerClass('softwaredeorgaocontroller');
        $this->assertMatchedRouteName('software-de-orgao');
    }

}
