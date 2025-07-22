<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Db\Sql\Expression;

class SoftwareTable extends AbstractTableGateway
{
    protected string $keyName = 'codigo';
    
    protected string $modelName = 'Application\Model\Software';
    
    /**
     *
     * @param string $where
     * @return ResultSetInterface
     */
    public function getModels($where = null, $order = null): ResultSetInterface
    {
        $select = $this->getSelect();
        if (!is_null($where)){
            $select->where(['software.codigo' => $where['codigo']]);
        }
        if (!is_null($order)){
            $select->order($order);
        }
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelect(): Select
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
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getTotalDeSoftwaresLivres()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['total_softwares' => new Expression('count(*)')]);
        $select->join('licenca', 'software.codigo_licenca=licenca.codigo',[]);
        $select->where(['licenca.livre' => true]);
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet->current()->total_softwares ?? 0;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getTotalDeSoftwaresNaoLivres()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['total_softwares' => new Expression('count(*)')]);
        $select->join('licenca', 'software.codigo_licenca=licenca.codigo',[]);
        $select->where(['licenca.livre' => false]);
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet->current()->total_softwares ?? 0;
    }
}