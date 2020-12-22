<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\SoftwareForm;

class SoftwareController extends AbstractCrudController
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
            $filterv = $this->getRequest()->getPost('nome');
            if (!empty($filterv)){
                $filtern = 'nome';
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
        $softwareForm = new SoftwareForm();
        $options = [];
        $categorias = $this->parentTable['categoria']->getModels(null,'nome');
        foreach($categorias as $categoria){
            $options[$categoria->codigo] = $categoria->nome;
        }
        $softwareForm->get('codigo_categoria')->setValueOptions($options);
        $options = [];
        $licencas = $this->parentTable['licenca']->getModels(null,'nome');
        foreach($licencas as $licenca){
            $options[$licenca->codigo] = $licenca->nome;
        }
        $softwareForm->get('codigo_licenca')->setValueOptions($options);
        return $softwareForm;
    }

    public function getEditTitle($key)
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Software';
    }
    
    protected function getSelect()
    {
        $nome = $this->getRequest()->getPost('nome');
        
        if (empty($nome)){
            $nome = $this->params('filterv');
        }        
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
}