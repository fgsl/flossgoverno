<?php
namespace Application\Controller;

use Fgsl\Mvc\Controller\AbstractCrudController;
use Application\Form\OrgaoForm;
use Laminas\Db\Sql\Select;
use Laminas\Form\Form;
use Laminas\View\Model\ViewModel;

class OrgaoController extends AbstractCrudController
{
    protected int $itemCountPerPage = 10;
    
    protected string $modelClass = 'Application\Model\Orgao';
    
    protected string $route = 'orgao';
    
    protected string $tableClass = 'Application\Model\OrgaoTable';
    
    protected string $pageArg = 'key';
    
    public function getForm($full = false): Form
    {
        $orgaoForm = new OrgaoForm();
        $options = [];
        $tipos = $this->parentTable->getModels();
        foreach($tipos as $tipo){
            $options[$tipo->codigo] = $tipo->nome;
        }
        $orgaoForm->get('tipo_orgao')->setValueOptions($options);
        return $orgaoForm;
    }
    
    public function getEditTitle($key): string
    {
        return (empty($key) ? 'Incluir ' : 'Alterar ') . 'Órgão';
    }
    
    protected function getPost(): \ArrayObject
    {
        $post = $this->getRequest()->getPost();
        $post['compra'] = (bool) $post['compra'];
        $post['justifica'] = (bool) $post['justifica'];
        $post['semresposta'] = (bool) $post['semresposta'];
        $post['depende'] = (bool) $post['depende'];
        return $post;
    }
    
    protected function getSelect(): Select
    {
        $nome = $this->getRequest()->getPost('nome');
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
    
    /**
     * The default action - show the home page
     */
    public function siglaAction()
    {
        $view = $this->getListView($this->getSiglaPaginator());
        if ($view instanceof ViewModel){
            $view->setTemplate('application/orgao/index.phtml');
        }
        return $view;
    }
    
    protected function getSiglaPaginator()
    {
        $alternativeSelect = $this->table->getSelectByAcronym($this->getRequest()->getPost('sigla'));
        return $this->getPaginator($alternativeSelect);
    }
}
