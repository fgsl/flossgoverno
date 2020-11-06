<?php
namespace Application\Controller;

use Application\Form\SoftwareDeOrgaoForm;
use Fgsl\Mvc\Controller\AbstractCrudController;

class SoftwareDeOrgaoController extends AbstractCrudController
{
    protected $itemCountPerPage = 10;
    
    protected $modelClass = 'Application\Model\Software';
    
    protected $route;
    
    protected $table;
    
    protected $parentTable;
    
    protected $tableClass = 'Application\Model\SoftwareTable';
    
    protected $title;
    
    protected $pageArg = 'key';
    
    public function getForm($full = FALSE)
    {
        $softwareDeOrgaoForm = new SoftwareDeOrgaoForm();
        $options = [];
        $softwares = $this->parentTable['software']->getModels();
        foreach($softwares as $software){
            $options[$software->codigo] = $software->nome;
        }
        $softwareDeOrgaoForm->get('codigo_software')->setValueOptions($options);
        $options = [];
        $orgaos = $this->parentTable['orgao']->getModels();
        foreach($orgaos as $orgao){
            $options[$orgao->codigo] = $orgao->nome;
        }
        $softwareDeOrgaoForm->get('codigo_orgao')->setValueOptions($options);
        return $softwareDeOrgaoForm;
    }

    public function getEditTitle($key)
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Software';
    }
    
    protected function getSelect()
    {
        $software = $this->getRequest()->getPost('software');
        $orgao = $this->getRequest()->getPost('orgao');
        
        if (!empty($software)){
            $this->itemCountPerPage = 60;
            return $this->table->getSelectBySoftware($software);            
        }
        if (!empty($orgao)){
            $this->itemCountPerPage = 60;
            return $this->table->getSelectByOrgao($orgao);
        }            
        
        return $this->table->getSelect();
    }   
}