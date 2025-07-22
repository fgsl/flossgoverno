<?php
namespace Application\Model;

use Fgsl\InputFilter\InputFilter;
use Fgsl\Model\AbstractActiveRecord;
use Laminas\Filter\ToInt;

class ProtocoloDeOrgao extends AbstractActiveRecord
{
    public function getInputFilter(): InputFilter
    {
        if ($this->inputFilter == null){
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('codigo_protocolo', new ToInt());
            $inputFilter->addFilter('codigo_orgao', new ToInt());
            $inputFilter->addChains();
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}