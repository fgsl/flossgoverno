<?php
namespace Application\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Application\Model\LicencaTable;

class LicencaControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('licenca', $adapter);
        $table = new LicencaTable($tableGateway);
        return new LicencaController($table);
    }
}