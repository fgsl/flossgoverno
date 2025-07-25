<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;

class CategoriaMaisUsadaController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\Categoria';
    
    protected string $route = 'categoria-mais-usada';
    
    protected string $tableClass = 'Application\Model\CategoriaTable';
    
    protected string $pageArg = 'key';
  
    protected function getSelect(): Select
    {
        return $this->table->getSelectTotalDeCategorias();
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