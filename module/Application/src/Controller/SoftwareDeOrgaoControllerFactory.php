<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Application\Model\SoftwareTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Application\Model\SoftwareDeOrgaoTable;
use Psr\Container\ContainerInterface;

class SoftwareDeOrgaoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('software_orgao', $adapter);
        $table = new SoftwareDeOrgaoTable($tableGateway);
        $tableGateway = new TableGateway('software', $adapter);
        $softwareTable = new SoftwareTable($tableGateway);
        $tableGateway = new TableGateway('orgao', $adapter);
        $orgaoTable = new OrgaoTable($tableGateway);
        $softwareDeOrgaoController = new SoftwareDeOrgaoController($table, $softwareTable);
        $softwareDeOrgaoController->setOtherParentTable($orgaoTable);
        return $softwareDeOrgaoController;
    }
}