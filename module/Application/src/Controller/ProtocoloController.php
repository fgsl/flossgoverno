<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\ProtocoloForm;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;

class ProtocoloController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\Protocolo';
    
    protected string $route = 'protocolo';
    
    protected string $tableClass = 'Application\Model\ProtocoloTable';
    
    protected string $title;
    
    protected string $pageArg = 'key';
    
    public function getForm($full = false): Form
    {
        return new ProtocoloForm();
    }

    public function getEditTitle($key): string
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Protocolo';
    }
    
    protected function getSelect(): Select
    {
        $nome = $this->getRequest()->getPost('nome');
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
}