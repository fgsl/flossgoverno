<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\TipoDeOrgaoForm;
use Laminas\Form\Form;

class TipoDeOrgaoController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\TipoDeOrgao';
    
    protected string $route = 'tipo-de-orgao';
    
    protected string $tableClass = 'Application\Model\TipoDeOrgaoTable';
    
    protected string $title = 'Tipo de Órgão';
    
    protected string $pageArg = 'key';
    
    public function getForm($full = false): Form
    {
        return new TipoDeOrgaoForm();
    }

    public function getEditTitle($key): string
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Tipo de Órgão';
    }
}

