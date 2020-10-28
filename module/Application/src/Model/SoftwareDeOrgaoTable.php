<?php
namespace Application\Model;

use Fgsl\Db\TableGateway\AbstractTableGateway;
use Laminas\Db\ResultSet\ResultSetInterface;
use Laminas\Db\Sql\Select;
use Laminas\Db\Sql\Where;
use Fgsl\Model\AbstractModel;
use Laminas\Db\Sql\Predicate\Predicate;
use Laminas\Db\Sql\Expression;

class SoftwareDeOrgaoTable extends AbstractTableGateway
{
    protected $keyName = ['codigo_software','codigo_orgao'];
    
    protected $modelName = 'Application\Model\SoftwareDeOrgao';
    
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
        $select->join('software', 'software.codigo=software_orgao.codigo_software',['software' => 'nome']);
        $select->join('orgao', 'orgao.codigo=software_orgao.codigo_orgao',['orgao' => 'nome']);
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectBySoftware($name)
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
    public function getSelectByOrgao($name)
    {
        $select = $this->getSelect();
        $where = new Where();
        $where->like('orgao.nome', '%' . $name . '%');
        $select->where($where);
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectTotalDeSoftwaresLivres()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['total' => new Expression('count(codigo_software)')]);
        $select->join('software', 'software.codigo=software_orgao.codigo_software',['software' => 'nome']);
        $select->join('licenca', 'licenca.codigo=software.codigo_licenca',['livre']);
        $select->where(['licenca.livre' => true]);
        $select->group('codigo_software');
        $select->order('total DESC');
        return $select;
    }

    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectTotalDeLicencasLivres()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['total' => new Expression('count(codigo_licenca)')]);
        $select->join('software', 'software.codigo=software_orgao.codigo_software',[]);
        $select->join('licenca', 'licenca.codigo=software.codigo_licenca',['licenca' => 'nome','livre']);
        $select->where(['licenca.livre' => true]);
        $select->group('codigo_licenca');
        $select->order('total DESC');
        return $select;
    }
    
    /**
     *
     * @return \Laminas\Db\Sql\Select
     */
    public function getSelectMaioresUsuarios()
    {
        $select = new Select($this->tableGateway->getTable());
        $select->columns(['total' => new Expression('count(codigo_orgao)')]);
        $select->join('orgao', 'orgao.codigo=software_orgao.codigo_orgao',['orgao' => 'nome']);
        $select->join('software', 'software.codigo=software_orgao.codigo_software',[]);
        $select->join('licenca', 'licenca.codigo=software.codigo_licenca',['livre']);
        $select->where(['licenca.livre' => true]);
        $select->group('codigo_orgao');
        $select->order('total DESC');
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
        $predicate->equalTo('codigo_software', $tokens[0]);
        $where->addPredicate($predicate);
        $predicate->equalTo('codigo_orgao', $tokens[1]);
        
        $this->tableGateway->delete($where);
    }    
}