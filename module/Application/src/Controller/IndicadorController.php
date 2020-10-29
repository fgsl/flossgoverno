<?php
namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Application\Model\OrgaoTable;
use Laminas\View\Model\ViewModel;

class IndicadorController extends AbstractActionController
{
    /** @var OrgaoTable **/
    private $orgaoTable;
    
    public function __construct(OrgaoTable $orgaoTable)
    {
        $this->orgaoTable = $orgaoTable;
    }
    
    public function indexAction()
    {
        $totais = [];
        $totais['total_compra'] = $this->orgaoTable->getTotalCompraSoftwareProprietario();
        $totais['total_justifica'] = $this->orgaoTable->getTotalJustificaCompra();
        $totais['total_sem_resposta'] = $this->orgaoTable->getTotalSemResposta();
        $totais['total_depende_de_avaliacao'] = $this->orgaoTable->getTotalDependeDeAvaliacao();
        $totais['total_desenvolveu_floss'] = $this->orgaoTable->getTotalDesenvolveuFloss();
        
        return new ViewModel($totais);
    }
}
