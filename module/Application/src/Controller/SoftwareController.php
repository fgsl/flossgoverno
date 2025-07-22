<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\SoftwareForm;
use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;

class SoftwareController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\Software';
    
    protected string $route = 'software';

    protected ?AbstractTableGateway $otherParentTable;
    
    protected string $tableClass = 'Application\Model\SoftwareTable';
    
    protected string $title;
    
    protected string $pageArg = 'key';

    public function setOtherParentTable(AbstractTableGateway $otherParentTable)
    {
        $this->otherParentTable = $otherParentTable;
    }
    
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
    
    public function getForm($full = false): Form
    {
        $softwareForm = new SoftwareForm();
        $options = [];
        $categorias = $this->parentTable->getModels(null,'nome');
        foreach($categorias as $categoria){
            $options[$categoria->codigo] = $categoria->nome;
        }
        $softwareForm->get('codigo_categoria')->setValueOptions($options);
        $options = [];
        $licencas = $this->otherParentTable->getModels(null,'nome');
        foreach($licencas as $licenca){
            $options[$licenca->codigo] = $licenca->nome;
        }
        $softwareForm->get('codigo_licenca')->setValueOptions($options);
        return $softwareForm;
    }

    public function getEditTitle($key): string
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Software';
    }
    
    protected function getSelect(): Select
    {
        $nome = $this->getRequest()->getPost('nome');
        
        if (empty($nome)){
            $nome = $this->params('filterv');
        }
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
}