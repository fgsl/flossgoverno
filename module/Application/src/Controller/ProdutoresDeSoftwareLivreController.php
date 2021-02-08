<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;

class ProdutoresDeSoftwareLivreController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\Orgao';
    
    protected $route;
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\OrgaoTable';
    
    protected $title;
    
    protected $pageArg = 'key';
  
    protected function getSelect()
    {
        return $this->table->getSelectProdutoresDeSoftwaresLivres();
    }
 
    public function getForm($full = FALSE)
    {}
    public function getEditTitle($key)
    {}   
}