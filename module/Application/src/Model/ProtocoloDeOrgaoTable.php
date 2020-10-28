<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Fgsl\Model\AbstractModel;
use Laminas\Db\Sql\Predicate\Predicate;

class ProtocoloDeOrgaoTable extends AbstractTableGateway
{
    protected $keyName = ['codigo_protocolo','codigo_orgao'];
    
    protected $modelName = 'Application\Model\ProtocoloDeOrgao';
    
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
        $select->join('protocolo', 'protocolo.codigo=protocolo_orgao.codigo_protocolo',['protocolo' => 'nome']);
        $select->join('orgao', 'orgao.codigo=protocolo_orgao.codigo_orgao',['orgao' => 'nome']);
        $select->order('protocolo.nome');
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectByProtocolo($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('protocolo.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectByOrgao($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('orgao.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
    
    public function save(AbstractModel $model)
    {
        $set = $model->getArrayCopy();
        try {
            $this->tableGateway->insert($set);
        } catch (\Exception $e) {
            error_log($e->getMessage());
        }
    }
    
    public function delete($key)
    {
        $tokens = explode('-',$key);
        
        $where = new Where();
        $predicate = new Predicate();
        $predicate->equalTo('codigo_protocolo', $tokens[0]);
        $where->addPredicate($predicate);
        $predicate->equalTo('codigo_orgao', $tokens[1]);
        
        $this->tableGateway->delete($where);
    }    
}