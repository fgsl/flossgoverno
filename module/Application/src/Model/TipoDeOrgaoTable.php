<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;

class TipoDeOrgaoTable extends AbstractTableGateway
{
    protected string $keyName = 'codigo';
    
    protected string $modelName = 'Application\Model\TipoDeOrgao';
}

