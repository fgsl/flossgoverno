<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\Sql\Where;
use Laminas\Db\ResultSet\ResultSetInterface;

class ProtocoloTable extends AbstractTableGateway
{
    protected $keyName = 'codigo';
    
    protected $modelName = 'Application\Model\Protocolo';
    
    /**
     *
     * @param string $where
     * @return ResultSetInterface
     */
    public function getModels($where = null)
    {
        $select = $this->getSelect();
        if (!is_null($where)){
            $select->where(['protocolo.codigo' => $where['codigo']]);
        }
        $select->order('protocolo.nome');
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectByName($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('protocolo.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
}

