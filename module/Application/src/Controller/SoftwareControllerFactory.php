<?php
namespace Application\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Application\Model\SoftwareTable;
use Application\Model\CategoriaDeSoftwareTable;
use Application\Model\LicencaTable;

class SoftwareControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('software', $adapter);
        $table = new SoftwareTable($tableGateway);
        $tableGateway = new TableGateway('categoria_software', $adapter);
        $categoriaTable = new CategoriaDeSoftwareTable($tableGateway);
        $tableGateway = new TableGateway('licenca', $adapter);
        $licencaTable = new LicencaTable($tableGateway);
        $parentTable = [
            'categoria' => $categoriaTable,
            'licenca' => $licencaTable            
        ];
        return new SoftwareController($table, $parentTable);
    }
}