<?php
namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Application\Model\OrgaoTable;
use Laminas\View\Model\ViewModel;
use Application\Model\SoftwareTable;

class IndicadorController extends AbstractActionController
{
    private OrgaoTable $orgaoTable;
    
    private SoftwareTable $softwareTable;
    
    public function __construct(OrgaoTable $orgaoTable, SoftwareTable $softwareTable)
    {
        $this->orgaoTable = $orgaoTable;
        $this->softwareTable = $softwareTable;
    }
    
    public function indexAction()
    {
        $totais = [];
        $totais['total_orgaos'] = $this->orgaoTable->getTotalDeOrgaos();
        $totais['total_compra'] = $this->orgaoTable->getTotalCompraSoftwareProprietario();
        $totais['total_justifica'] = $this->orgaoTable->getTotalJustificaCompra();
        $totais['total_sem_resposta'] = $this->orgaoTable->getTotalSemResposta();
        $totais['total_depende_de_avaliacao'] = $this->orgaoTable->getTotalDependeDeAvaliacao();
        $totais['total_desenvolveu_floss'] = $this->orgaoTable->getTotalDesenvolveuFloss();
        $totais['total_softwares_livres'] = $this->softwareTable->getTotalDeSoftwaresLivres();
        $totais['total_softwares_nao_livres'] = $this->softwareTable->getTotalDeSoftwaresNaoLivres();
        
        return new ViewModel($totais);
    }
}
