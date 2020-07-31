<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Application\Model\TipoDeOrgaoTable;
use Interop\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Db\ResultSet\ResultSet;
use Application\Model\Orgao;

class OrgaoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new Orgao('codigo','orgao',$adapter));
        $tableGateway = new TableGateway('orgao', $adapter, null, $resultSet);
        $table = new OrgaoTable($tableGateway);
        $tableGateway = new TableGateway('tipo_orgao', $adapter);
        $parentTable = new TipoDeOrgaoTable($tableGateway);
        return new OrgaoController($table, $parentTable);
    }
}