<?php
namespace Application\Model;

use Fgsl\InputFilter\InputFilter;
use Fgsl\Model\AbstractActiveRecord;
use Laminas\Filter\ToInt;

class SoftwareDeOrgao extends AbstractActiveRecord
{
    public function getInputFilter(): InputFilter
    {
        if ($this->inputFilter == null){
            $inputFilter = new InputFilter();
            $inputFilter->addFilter('codigo_software', new ToInt());
            $inputFilter->addFilter('codigo_orgao', new ToInt());
            $inputFilter->addChains();
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }
}