<?php
namespace Application\Controller;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Db\TableGateway\TableGateway;
use Application\Model\TipoDeOrgaoTable;
use Laminas\Db\ResultSet\ResultSet;
use Application\Model\TipoDeOrgao;
use Psr\Container\ContainerInterface;

class TipoDeOrgaoControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype(new TipoDeOrgao('codigo', 'tipo_orgao', $adapter));
        $tableGateway = new TableGateway('tipo_orgao', $adapter, null, $resultSet);
        $table = new TipoDeOrgaoTable($tableGateway);
        return new TipoDeOrgaoController($table);
    }
}

