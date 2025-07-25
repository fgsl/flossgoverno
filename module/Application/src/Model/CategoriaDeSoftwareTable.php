<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Where;

class CategoriaDeSoftwareTable extends AbstractTableGateway
{
    protected string $keyName = 'codigo';
    
    protected string $modelName = 'Application\Model\CategoriaDeSoftware';
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectByName($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('categoria_software.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
    
    /**
     *
     * @param string $where
     * @return ResultSetInterface
     */
    public function getModels($where = null, $order = null): ResultSetInterface
    {
        $select = $this->getSelect();
        if (!is_null($where)){
            $select->where($where);
        }
        if (!is_null($order)){
            $select->order($order);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
}