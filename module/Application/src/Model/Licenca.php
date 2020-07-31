<?php
namespace Application\Model;

use Fgsl\Model\AbstractModel;
use Fgsl\InputFilter\InputFilter;
use Laminas\Filter\ToInt;
use Laminas\Filter\StringTrim;
use Laminas\Validator\StringLength;
use Laminas\Filter\Boolean;

class Licenca extends AbstractModel
{
    public function getInputFilter()
    {
        if ($this->inputFilter == null){
            $inputFilter = new InputFilter();
            $inputFilter->addInput('livre',false);
            $inputFilter->addFilter('codigo', new ToInt());
            $inputFilter->addFilter('nome', new StringTrim());
            $inputFilter->addFilter('livre', new Boolean());
            $inputFilter->addValidator('nome', new StringLength(['min'=>3,'max'=>80]));
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