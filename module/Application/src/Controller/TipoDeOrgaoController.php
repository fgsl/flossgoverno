<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\TipoDeOrgaoForm;

class TipoDeOrgaoController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\TipoDeOrgao';
    
    protected $route = 'tipo-de-orgao';
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\TipoDeOrgaoTable';
    
    protected $title = 'Tipo de Órgão';
    
    protected $pageArg = 'key';
    
    public function getForm($full = FALSE)
    {
        return new TipoDeOrgaoForm();
    }

    public function getEditTitle($key)
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Tipo de Órgão';
    }
}

