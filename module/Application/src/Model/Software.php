<?php
namespace Application\Model;

use Fgsl\InputFilter\InputFilter;
use Fgsl\Model\AbstractActiveRecord;
use Laminas\Filter\ToInt;
use Laminas\Filter\StringTrim;
use Laminas\Validator\StringLength;

class Software extends AbstractActiveRecord
{
    public function getInputFilter(): InputFilter
    {
        if ($this->inputFilter == null){
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('codigo', new ToInt());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addFilter('codigo_categoria', new ToInt());
            $inputFilter->addFilter('website', new StringTrim());
            $inputFilter->addFilter('codigo_licenca', new ToInt());
            $inputFilter->addFilter('observacoes', new StringTrim());
            $inputFilter->addValidator('nome', new StringLength(['min'=>3,'max'=>80]));
            $inputFilter->addValidator('website', new StringLength(['min'=>0,'max'=>80]));
            $inputFilter->addValidator('observacoes', new StringLength(['min'=>0,'max'=>255]));
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
}