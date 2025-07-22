<?php

use Application\Model\Protocolo;
use Fgsl\Mock\Db\Adapter\Mock as MockAdapter;
use PHPUnit\Framework\TestCase;

class DefaultModelTest extends TestCase
{
    public function testModel()
    {
        $adapter = new MockAdapter();
        $protocolo = new Protocolo('codigo','protocolo',$adapter);
        $this->assertIsObject($protocolo->getInputFilter());
    }
}