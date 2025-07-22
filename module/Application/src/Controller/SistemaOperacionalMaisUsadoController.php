<?php
namespace Application\Controller;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Fgsl\Mvc\Controller\AbstractCrudController;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;

class SistemaOperacionalMaisUsadoController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\Software';
    
    protected string $route = 'sistema-operacional-mais-usado';
    
    protected string $tableClass = 'Application\Model\SoftwareTable';
    
    protected string $pageArg = 'key';
  
    protected function getSelect(): Select
    {
        return $this->table->getSelectSistemasOperacionaisMaisUsados();
    }
 
    public function getForm($full = false): Form
    {
        return new Form();
    }
    public function getEditTitle($key): string
    {
        return '';
    }
}