<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Interop\Container\ContainerInterface;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;

class ProdutoresDeSoftwareLivreControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('orgao', $adapter);
        $table = new OrgaoTable($tableGateway);
        return new ProdutoresDeSoftwareLivreController($table);
    }
}