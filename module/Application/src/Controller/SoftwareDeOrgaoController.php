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
    
    
    public function indexAction()
    {
        $filtern = $this->params('filtern');
        $filterv = $this->params('filterv');
        
        if ($filtern == ''){
            $filterv = $this->getRequest()->getPost('software');
            if ($filterv == ''){
                $filterv = $this->getRequest()->getPost('orgao');
                if (!empty($filterv)){
                    $filtern = 'orgao';
                }
            } else {
                $filtern = 'software';
            }
        }
        $view = parent::indexAction();
        $view->setVariables([
            'filtern' => $filtern,
            'filterv' => $filterv
        ]);
        return $view;
    }

    public function pageAction()
    {
        $params = [$this->pageArg => $this->params('key')];
        $filtern = $this->params('filtern');
        $filterv = $this->params('filterv');
        if (!empty($filtern)){
            $params['filtern'] = $filtern;
            $params['filterv'] = $filterv;
        }
        return $this->redirect()->toRoute($this->route, $params);
    }
    
    public function getForm($full = FALSE)
    {
        $softwareDeOrgaoForm = new SoftwareDeOrgaoForm();
        $options = [];
        $softwares = $this->parentTable['software']->getModels(null, 'nome');
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
        return (empty($key) ? 'Associar ' : 'Alterar ') . 'Software';
    }
    
    protected function getSelect()
    {
        $software = $this->getRequest()->getPost('software');
        $orgao = $this->getRequest()->getPost('orgao');
        
        $filtern = $this->params('filtern');
        $filterv = $this->params('filterv');
        
        if ($filtern == 'software'){
            $software = $filterv;
        }
        
        if ($filtern == 'orgao'){
            $orgao = $filterv;
        }        
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