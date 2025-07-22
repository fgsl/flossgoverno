<?php
namespace Application\Controller;

use Application\Model\OrgaoTable;
use Laminas\Db\TableGateway\TableGateway;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Psr\Container\ContainerInterface;

class ProdutoresDeSoftwareLivreControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        $adapter = $container->get('Laminas\Db\Adapter');
        $tableGateway = new TableGateway('orgao', $adapter);
        $table = new OrgaoTable($tableGateway);
        return new ProdutoresDeSoftwareLivreController($table);
    }
}