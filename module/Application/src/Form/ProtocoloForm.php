<?php
namespace Application\Form;

use Fgsl\Form\AbstractForm;

class ProtocoloForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct('protocolo');
        $this->addElement('nome', AbstractForm::TEXT,'Nome:',['autofocus'=>'autofocus']);
        $this->addElement('codigo', AbstractForm::HIDDEN);
        $this->addelement('submit',AbstractForm::SUBMIT,'gravar');
    }    
}