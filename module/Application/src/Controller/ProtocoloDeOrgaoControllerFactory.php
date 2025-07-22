<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Application\Model\ProtocoloDeOrgaoTable;
use Application\Model\ProtocoloTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ProtocoloDeOrgaoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('protocolo_orgao', $adapter);
        $table = new ProtocoloDeOrgaoTable($tableGateway);
        $tableGateway = new TableGateway('protocolo', $adapter);
        $protocoloTable = new ProtocoloTable($tableGateway);
        $tableGateway = new TableGateway('orgao', $adapter);
        $orgaoTable = new OrgaoTable($tableGateway);
        $protocoloDeOrgaoController = new ProtocoloDeOrgaoController($table, $protocoloTable);
        $protocoloDeOrgaoController->setOtherParentTable($orgaoTable);
        return $protocoloDeOrgaoController;
    }
}