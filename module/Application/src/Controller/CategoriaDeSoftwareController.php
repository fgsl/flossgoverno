<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\CategoriaDeSoftwareForm;

class CategoriaDeSoftwareController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\CategoriaDeSoftware';
    
    protected $route;
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\CategoriaDeSoftwareTable';
    
    protected $title;
    
    protected $pageArg = 'key';
    
    public function getForm($full = FALSE)
    {
        return new CategoriaDeSoftwareForm();
    }
    
    public function getEditTitle($key)
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Categoria de Software';
    }
    
    protected function getSelect()
    {
        $nome = $this->getRequest()->getPost('nome');
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
}

