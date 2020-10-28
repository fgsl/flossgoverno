<?php
namespace Application\Controller;

use Application\Form\ProtocoloDeOrgaoForm;
use Fgsl\Mvc\Controller\AbstractCrudController;

class ProtocoloDeOrgaoController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\ProtocoloDeOrgao';
    
    protected $route;
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\ProtocoloDeOrgaoTable';
    
    protected $title;
    
    protected $pageArg = 'key';
    
    public function getForm($full = FALSE)
    {
        $protocoloDeOrgaoForm = new ProtocoloDeOrgaoForm();
        $options = [];
        $protocolos = $this->parentTable['protocolo']->getModels();
        foreach($protocolos as $protocolo){
            $options[$protocolo->codigo] = $protocolo->nome;
        }
        $protocoloDeOrgaoForm->get('codigo_protocolo')->setValueOptions($options);
        $options = [];
        $orgaos = $this->parentTable['orgao']->getModels();
        foreach($orgaos as $orgao){
            $options[$orgao->codigo] = $orgao->nome;
        }
        $protocoloDeOrgaoForm->get('codigo_orgao')->setValueOptions($options);
        return $protocoloDeOrgaoForm;
    }

    public function getEditTitle($key)
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Protocolo';
    }
    
    protected function getSelect()
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