<?php
namespace Application\Controller;

use Application\Model\Orgao;
use Application\Model\OrgaoTable;
use Application\Model\SoftwareTable;
use Psr\Container\ContainerInterface;
use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndicadorControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Orgao('codigo','orgao',$adapter));
        $tableGateway = new TableGateway('orgao', $adapter, null, $resultSet);
        $table = new OrgaoTable($tableGateway);
        $tableGateway = new TableGateway('software', $adapter);
        $parentTable = new SoftwareTable($tableGateway);
        return new IndicadorController($table, $parentTable);
    }
}