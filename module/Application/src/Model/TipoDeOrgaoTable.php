<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;

class TipoDeOrgaoTable extends AbstractTableGateway
{
    protected $keyName = 'codigo';
    
    protected $modelName = 'Application\Model\TipoDeOrgao';   
}

