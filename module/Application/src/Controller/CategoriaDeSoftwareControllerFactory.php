<?php
namespace Application\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Application\Model\CategoriaDeSoftwareTable;

class CategoriaDeSoftwareControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('categoria_software', $adapter);
        $table = new CategoriaDeSoftwareTable($tableGateway);
        return new CategoriaDeSoftwareController($table);
    }
}