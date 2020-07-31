<?php
namespace Application\Form;

use Fgsl\Form\AbstractForm;

class SoftwareForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct('software');
        $this->addElement('nome', AbstractForm::TEXT,'Nome:',['autofocus'=>'autofocus','class'=>'form-control']);
        $this->addElement('codigo_categoria', AbstractForm::SELECT, 'Categoria:',['class'=>'form-control']);
        $this->addElement('codigo_licenca', AbstractForm::SELECT,'Licença:',['class'=>'form-control']);
        $this->addElement('website', AbstractForm::TEXT, 'Website:',['class'=>'form-control']);
        $this->addElement('observacoes', 'textarea','Observações:',['class'=>'form-control']);
        $this->addElement('codigo', AbstractForm::HIDDEN);
        $this->addelement('submit',AbstractForm::SUBMIT,'gravar',['class'=>'form-control']);
    }    
}