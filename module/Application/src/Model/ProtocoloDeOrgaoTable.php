<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Fgsl\Model\AbstractActiveRecord;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Laminas\Db\Sql\Predicate\Predicate;

class ProtocoloDeOrgaoTable extends AbstractTableGateway
{
    protected string $keyName = 'codigo_protocolo-codigo_orgao';
    
    protected string $modelName = 'Application\Model\ProtocoloDeOrgao';

    /**
     *
     * @param mixed $key
     */
    public function getModel($key): AbstractActiveRecord
    {
        $key = $key ?? '-';
        $keyNames = explode('-',$this->keyName);
        $keyValues = explode('-',$key);
        $models = $this->getModels([
            $keyNames[0] => $keyValues[0],
            $keyNames[1] => $keyValues[1]
        ]);
        if ($models->count() == 0 || $models->current() == null ){
            $model = $this->modelName;
            return new $model(
                $keyNames,
                $this->tableGateway->getTable(),
                $this->tableGateway->getAdapter());
        }
        return $models->current();
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
    
    public function save(AbstractActiveRecord $model, $excludePrimaryKey = false)
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