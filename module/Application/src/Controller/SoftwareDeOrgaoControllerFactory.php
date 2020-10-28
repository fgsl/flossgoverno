<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Application\Model\SoftwareTable;
use Interop\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Model\SoftwareDeOrgaoTable;

class SoftwareDeOrgaoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('software_orgao', $adapter);
        $table = new SoftwareDeOrgaoTable($tableGateway);
        $tableGateway = new TableGateway('software', $adapter);
        $softwareTable = new SoftwareTable($tableGateway);
        $tableGateway = new TableGateway('orgao', $adapter);
        $orgaoTable = new OrgaoTable($tableGateway);
        $parentTable = [
            'software'  => $softwareTable,
            'orgao'     => $orgaoTable 
        ];
        return new SoftwareDeOrgaoController($table, $parentTable);
    }
}