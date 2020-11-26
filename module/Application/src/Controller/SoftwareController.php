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
        
        return empty($nome) ? $this->table->getSelect() : $this->table->getSelectByName($nome);
    }
}