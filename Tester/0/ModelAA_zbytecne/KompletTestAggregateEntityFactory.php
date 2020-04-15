<?php
namespace Tester\Model\Aggregate\EntityFactory;

//use Tester\Model\Prikaz\VstupniPrikazUkaz;
use Tester\Model\Aggregate\Entity\KompletTestAggregate;
use Tester\Model\Db\Dao\PrubehTestu;
use Tester\Model\Db\Dao\DaoKonfiguraceTestu;
use Tester\Model\Db\Dao\SadaOtazek;
use Tester\Model\Session\Repository\SessionTestu;
//use Tester\Model\Aggregate\Hydrator\TestAggregateHydrator;
use Tester\Model\File\Repository\Ulohy;
use Tester\Model\Db\Dao\Odpoved;
use Tester\Model\Db\Dao\OdpovedNaOtazku;



/**
 * Description of KompletTestAggregateEntityFactory
 *
 * @author vlse2610
 */
class __KompletTestAggregateEntityFactory implements KompletTestAggregateEntityFactoryInterface  {
            
    private $repoPrubehTestu;       
    private $repoKonfiguraceTestu;            
    private $repoSadaOtazek ;
    private $repoUlohy; 
  //  private $repoTicketPouzity;

    private $repoOdpoved; 
    
    private $repoSessionTestu;
    
    
    public function __construct(              
                                       PrubehTestu $repoPrubehTestu,             
                                  DaoKonfiguraceTestu $repoKonfiguraceTestu,
                                        SadaOtazek $repoSadaOtazek,
                                             Ulohy $repoUlohy,
                                    /* TicketPouzity $repoTicketPouzity,*/            
                                           Odpoved $repoOdpoved,
                                   OdpovedNaOtazku $repoOdpovedNaOtazku,                                   
                                      SessionTestu $repoSessionTestu                                                
            
                            /* TestAggregateHydrator $hydrator */   ) {         
        
         $this->repoPrubehTestu = $repoPrubehTestu;
         $this->repoKonfiguraceTestu = $repoKonfiguraceTestu;   
         $this->repoSadaOtazek = $repoSadaOtazek;
         $this->repoUlohy = $repoUlohy;          
         //$this->repoTicketPouzity = $repoTicketPouzity;                           
         $this->repoOdpoved = $repoOdpoved;        
         $this->repoSessionTestu = $repoSessionTestu;
                  
        // $this->repoStavTabbedu = $repoStavTabbedu;         
       //  $this->hydrator = $hydrator;     
    }
    
    
    /**    
     * Vyrobí NOVÝ objekt  KompletTestAggregate entity.
     * A naplni ho hodnotami 'podle/z' inicializacni routy ( $idPrubehTestu, $identifikatorTicket). V session nepredpoklada 'nic'.
     * Pouzije se při GET při vytvářeni nového (ale již persistovaného) objektu testu. Vyhledá ho podle $idPrubehTestu.
     *     
     * @param type $idPrubehTestu
     * @param type $identifikatorTicketu
     * 
     * @return \Tester\Model\Aggregate\Entity\KompletTestAggregate
     * @throws \UnexpectedValueException
     */
    public function createByPrubeh ( $idPrubehTestu , $identifikatorTicketu ) : KompletTestAggregate {
        
        $prubehTestuE = $this->repoPrubehTestu->get( $idPrubehTestu);             
        $konfiguraceTestuE = $this->repoKonfiguraceTestu->get( $prubehTestuE->uidKonfiguraceTestuFk);                                 

        $sadaOtazekE = $this->repoSadaOtazek->get( $konfiguraceTestuE->idSadaUlohFk);        
        $arrayOtazkyC = $this->repoUlohy->find($sadaOtazekE->nazevSady);                  
        //odpoved
        $odpovedE = $this->repoOdpoved->getByPrubehTestuId($prubehTestuE->idPrubehTestu) ;          
               // odpovedi jsou "zakompilovane" v sessionTabbedu ulozenem v odpovedi
        
         //vyrobi novy obj. Session spusteny test
        $sessionTestu = new SessionEntity\SessionTestu(); 
        $sessionTestu->testUkoncen = \TRUE;  // zde???? nebo /novou vlastnost -testCten????      
        $sessionTestu->testZahajen = \FALSE; 
        
        //-------------------------------- novy  komplet aggregate entitu = $kompletTestAggregateE 
        $kompletTestAggregateE = new KompletTestAggregate(); 
        
        $kompletTestAggregateE->prubehTestu = $prubehTestuE;
        $kompletTestAggregateE->idKompletTestAggregate = $prubehTestuE->idPrubehTestu;  //!!!
        $kompletTestAggregateE->konfiguraceTestu = $konfiguraceTestuE;       
        $kompletTestAggregateE->sadaUloh = $sadaOtazekE;
        $kompletTestAggregateE->ulohy = $arrayOtazkyC;                
        $kompletTestAggregateE->odpoved = $odpovedE;  //zde je sessionTabbedu  
        $kompletTestAggregateE->sessionTestu = $sessionTestu;
       
       
        return $kompletTestAggregateE; 
                    
    }
            
}
         
        //nepotrebuju  $kompletTestAggregateE->odpovediNaOtazky
//       //---------------pro zapis do odpovedi---
//         $odpovediNaOtazkuCol = array();
//            //v key jsou identifikatory
//            foreach ($vsechnyOdpovedi as $key=>$value) { 
//                $odpovedNaOtazku = new DbEntity\OdpovedNaOtazku();  
//                $odpovedNaOtazku->identifikatorOdpovedi = $key ;
//                $odpovedNaOtazku->hodnota = $value ;
//                $odpovedNaOtazku->idPrubehTestuFk = $idPrubehTestu;       
//                $odpovediNaOtazkuCol[] = $odpovedNaOtazku;
//            }                      
//            
//            $odpovedE =  new DbEntity\Odpoved();           
//            $odpovedE->idPrubehTestuFk = $idPrubehTestu;
//        
//            $novaOdpovedAggregateE = new OdpovedAggregate();                
//            // hydrate         
//            $novaOdpovedAggregateE->stav =  $sessionStavEntity; 
//            $novaOdpovedAggregateE->odpoved = $odpovedE;
//            $novaOdpovedAggregateE->odpovediNaOtazky = $odpovediNaOtazkuCol;
            
        
//        $odpovedE = $this->repoOdpoved->getByPrubehTestuId($prubehTestuE->idPrubehTestu) ;
//        $kompletTestAggregateE->odpoved = $odpovedE;
//        
//        $poleNahrad = array();
//        $sqlTemplateWhere = "id_prubeh_testu_fk =  " .$prubehTestuE->idPrubehTestu;
//        $kompletTestAggregateE->odpovediNaOtazky  = $this->repoOdpovedNaOtazku->find($sqlTemplateWhere, $poleNahrad);
//                                                        //pozn.: $this ->repoOdpovedNaOtazku->find( 'id_prubeh_testu = ', $pole)
//        
              
