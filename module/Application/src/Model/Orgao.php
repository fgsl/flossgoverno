<?php
namespace Application\Model;

use Fgsl\InputFilter\InputFilter;
use Fgsl\Model\AbstractModel;
use Laminas\Filter\Boolean;
use Laminas\Filter\StringTrim;
use Laminas\Filter\ToInt;
use Laminas\I18n\Validator\IsInt;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\StringLength;

class Orgao extends AbstractModel
{
    public function getInputFilter()
    {
        if ($this->inputFilter == null){
            $inputFilter = new InputFilter();
            $inputFilter->addInput('nome');
            $inputFilter->addInput('tipo_orgao');
            $inputFilter->addInput('compra',false);
            $inputFilter->addInput('justifica',false);
            $inputFilter->addInput('semresposta',false);
            $inputFilter->addInput('depende',false);
            $inputFilter->addInput('sigla',false);
            $inputFilter->addInput('pedidos');
            $inputFilter->addInput('desenvolveusl',false);
            $inputFilter->addFilter('codigo', new ToInt());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addFilter('tipo_orgao', new ToInt());
            $inputFilter->addFilter('compra', new Boolean());
            $inputFilter->addFilter('justifica', new Boolean());
            $inputFilter->addFilter('semresposta', new Boolean());
            $inputFilter->addFilter('depende', new Boolean());
            $inputFilter->addFilter('sigla', new StringTrim());
            $inputFilter->addFilter('pedidos', new ToInt());
            $inputFilter->addValidator('nome', new StringLength(['min'=>3,'max'=>80]));
            $inputFilter->addValidator('tipo_orgao', new IsInt());
            $inputFilter->addValidator('compra', new NotEmpty(NotEmpty::NULL));
            $inputFilter->addValidator('justifica', new NotEmpty(NotEmpty::NULL));
            $inputFilter->addValidator('semresposta', new NotEmpty(NotEmpty::NULL));
            $inputFilter->addValidator('depende', new NotEmpty(NotEmpty::NULL));
            $inputFilter->addValidator('desenvolveusl', new NotEmpty(NotEmpty::NULL));
            $inputFilter->addValidator('pedidos', new IsInt());
            $inputFilter->addChains();
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
    
    public function getArrayCopy()
    {
        $data = $this->data;
        
        if (empty($this->data['codigo'])){
            unset($data['codigo']);
        }

        return $data;
    }
    
    public function __get($name){
        switch ($name) {
            case 'total_compra'                 :
            case 'total_justifica'              :
            case 'total_sem_resposta'           :
            case 'total_depende_de_avaliacao'   :
            case 'total_desenvolveu_floss'      :
                return $this->data[$name];
            default: 
                return parent::__get($name);
        }
    }
}