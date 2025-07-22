<?php
namespace Application\Controller;

use Application\Form\ProtocoloDeOrgaoForm;
use Fgsl\Db\TableGateway\AbstractTableGateway;
use Fgsl\Mvc\Controller\AbstractCrudController;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;

class ProtocoloDeOrgaoController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\ProtocoloDeOrgao';
    
    protected string $route = 'protocolo-de-orgao';
    
    protected ?AbstractTableGateway $otherParentTable;
    
    protected string $tableClass = 'Application\Model\ProtocoloDeOrgaoTable';
    
    protected string $pageArg = 'key';


    public function setOtherParentTable(AbstractTableGateway $otherParentTable)
    {
        $this->otherParentTable = $otherParentTable;
    }
    
    public function getForm($full = false): Form
    {
        $protocoloDeOrgaoForm = new ProtocoloDeOrgaoForm();
        $options = [];
        $protocolos = $this->parentTable->getModels();
        foreach($protocolos as $protocolo){
            $options[$protocolo->codigo] = $protocolo->nome;
        }
        $protocoloDeOrgaoForm->get('codigo_protocolo')->setValueOptions($options);
        $options = [];
        $orgaos = $this->otherParentTable->getModels();
        foreach($orgaos as $orgao){
            $options[$orgao->codigo] = $orgao->nome;
        }
        $protocoloDeOrgaoForm->get('codigo_orgao')->setValueOptions($options);
        return $protocoloDeOrgaoForm;
    }

    public function getEditTitle($key): string
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Protocolo';
    }
    
    protected function getSelect(): Select
    {
        $protocolo = $this->getRequest()->getPost('protocolo');
        $orgao = $this->getRequest()->getPost('orgao');
        
        if (!empty($protocolo)){
            return $this->table->getSelectByProtocolo($protocolo);
        }
        if (!empty($orgao)){
            return $this->table->getSelectByOrgao($orgao);
        }
        
        return $this->table->getSelect();
    }
}