<?php
namespace Application\Form;

use Fgsl\Form\AbstractForm;

class OrgaoForm extends AbstractForm
{
    public function __construct()
    {
        parent::__construct('orgao');
        $this->addElement('nome', AbstractForm::TEXT,'Nome:',['autofocus'=>'autofocus','class'=>'form-control']);
        $this->addElement('tipo_orgao', AbstractForm::SELECT, 'Tipo:',['class'=>'form-control']);
        $this->addElement('sigla', AbstractForm::TEXT,'Sigla:',['class'=>'form-control']);
        $this->addElement('pedidos', AbstractForm::NUMBER, 'Pedidos:',['class'=>'form-control']);
        $this->addElement('compra', AbstractForm::CHECKBOX, 'Compra software sem justificativa:');
        $this->addElement('justifica', AbstractForm::CHECKBOX, 'Justifica a compra:');
        $this->addElement('semresposta', AbstractForm::CHECKBOX, 'Não respondeu:');
        $this->addElement('depende', AbstractForm::CHECKBOX, 'A compra depende de critérios técnicos:');
        $this->addElement('desenvolveusl', AbstractForm::CHECKBOX, 'Desenvolveu software livre:');
        $this->addElement('codigo', AbstractForm::HIDDEN);
        $this->addelement('submit',AbstractForm::SUBMIT,'gravar',['class'=>'form-control']);
    }
}

