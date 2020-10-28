<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;

class SoftwareTable extends AbstractTableGateway
{
    protected $keyName = 'codigo';
    
    protected $modelName = 'Application\Model\Software';
    
    /**
     *
     * @param string $where
     * @return ResultSetInterface
     */
    public function getModels($where = null)
    {
        $select = $this->getSelect();
        if (!is_null($where)){
            $select->where(['software.codigo' => $where['codigo']]);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelect()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->join('categoria_software', 'software.codigo_categoria=categoria_software.codigo',['categoria' => 'nome']);
        $select->join('licenca', 'software.codigo_licenca=licenca.codigo',['licenca' => 'nome']);
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectByName($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('software.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
}