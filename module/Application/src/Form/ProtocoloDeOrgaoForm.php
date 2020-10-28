<?php
namespace Application\Form;

use Fgsl\Form\AbstractForm;

class ProtocoloDeOrgaoForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct('software');
        $this->addElement('codigo_protocolo', AbstractForm::SELECT, 'Protocolo:',['class'=>'form-control']);
        $this->addElement('codigo_orgao', AbstractForm::SELECT,'Órgão:',['class'=>'form-control']);
        $this->addelement('submit',AbstractForm::SUBMIT,'gravar',['class'=>'form-control']);
    }    
}