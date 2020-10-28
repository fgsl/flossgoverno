<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;

class MaiorUsuarioController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\Software';
    
    protected $route;
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\SoftwareTable';
    
    protected $title;
    
    protected $pageArg = 'key';
  
    protected function getSelect()
    {
        return $this->table->getSelectMaioresUsuarios();
    }
 
    public function getForm($full = FALSE)
    {}
    public function getEditTitle($key)
    {}   
}