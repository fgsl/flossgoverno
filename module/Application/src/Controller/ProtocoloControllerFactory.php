<?php
namespace Application\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Db\TableGateway\TableGateway;
use Application\Model\ProtocoloTable;
use Psr\Container\ContainerInterface;

class ProtocoloControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('protocolo', $adapter);
        $table = new ProtocoloTable($tableGateway);
        return new ProtocoloController($table);
    }
}