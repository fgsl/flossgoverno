<?php
namespace Application\Controller;

use Interop\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Model\SoftwareDeOrgaoTable;

class SistemaOperacionalMaisUsadoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('software_orgao', $adapter);
        $table = new SoftwareDeOrgaoTable($tableGateway);
        return new SistemaOperacionalMaisUsadoController($table);
    }
}