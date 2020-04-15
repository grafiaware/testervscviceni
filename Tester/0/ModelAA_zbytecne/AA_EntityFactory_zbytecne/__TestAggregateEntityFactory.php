<?php
namespace Tester\Model\Aggregate\EntityFactory;

use Tester\Model\Aggregate\EntityFactory\TestAggregateEntityFactoryInterface;
//use Tester\Model\Prikaz\VstupniPrikazSpust;

use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Entity as SessionEntity;

use Tester\Model\Db\Dao\PrubehTestu;
use Tester\Model\Db\Dao\DaoKonfiguraceTestu;
use Tester\Model\Db\Dao\SadaOtazek;
use Tester\Model\File\Repository\Ulohy ;
use Tester\Model\Db\Dao\TicketPouzity;
use Tester\Model\Session\Repository\SessionTestu;

use Tester\Model\Aggregate\Hydrator\TestAggregateHydrator;

/**
 * Description of SpustenyTestAgregateEntityFactory
 *
 * @author vlse2610
 */
class __TestAggregateEntityFactory implements TestAggregateEntityFactoryInterface {
           
    private $repoPrubehTestu;       
    private $repoKonfiguraceTestu;            
    private $repoSadaOtazek ;
    private $repoUlohy; 
    private $repoTicketPouzity;
    private $sessionTestu;
    
  //  private $hydrator;
    
    public function __construct(              
                                       PrubehTestu $repoPrubehTestu,             
                                  DaoKonfiguraceTestu $repoKonfiguraceTestu,
                                        SadaOtazek $repoSadaOtazek,
                                             Ulohy $repoUlohy,
                                     TicketPouzity $repoTicketPouzity,
                                        SessionTestu $sessionTestu
             
                            /* TestAggregateHydrator $hydrator */   ) {
                 
         $this->repoPrubehTestu = $repoPrubehTestu;
         $this->repoKonfiguraceTestu = $repoKonfiguraceTestu;   
         $this->repoSadaOtazek = $repoSadaOtazek;
         $this->repoUlohy = $repoUlohy;          
         $this->repoTicketPouzity = $repoTicketPouzity;
         $this->sessionTestu = $sessionTestu;
         
        // $this->hydrator = $hydrator;     
    }
    
    
    
    /**
     * Vyrobí NOVÝ objekt  TestAggregate entity.
     * A naplni ho hodnotami 'podle/z' inicializacni routy ( $uidKonfiguraceTestu, $identifikatorTicket). V session nepredpoklada 'nic'.
     * Pouzije se při GET při vytvářeni nového (ještě nepersistovaného) objektu testu.
     * 
     * @param type $uidKonfiguraceTestu
     * 
     * @return \Tester\Model\Aggregate\Entity\TestAggregate
     * @throws \UnexpectedValueException
     */                    
    public function createByKonfigurace( $uidKonfiguraceTestu  )  : AggEntity\TestAggregate  {
            // podle $uidKonfiguraceTestu  vybere konfiguraci testu
            $konfiguraceTestuE  = $this->repoKonfiguraceTestu->get($uidKonfiguraceTestu);   //$uidKonfiguraceTestu
            if (!isset($konfiguraceTestuE)) {
                throw new \UnexpectedValueException("Neexistuje zadaná konfigurace testu. Zadáno uid: $uidKonfiguraceTestu.");
            }
            
            $sadaOtazekE = $this->repoSadaOtazek->get($konfiguraceTestuE->idSadaUlohFk);        
            $arrayUlohyC = $this->repoUlohy->find($sadaOtazekE->nazevSady);
                        
            $prubehTestuE =  new DbEntity\RowObjectPrubehTestu();
            $prubehTestuE->uidKonfiguraceTestuFk = $konfiguraceTestuE->uidKonfiguraceTestu;  // priradim zde { nepriradim az v add do agg.repository}
           
            //vyrobi novy obj. Ticket Pouzity a zapise do neho identifikatorTicketu (ze vstupni routy)
            $ticketPouzityE = new DbEntity\RowObjectTicketPouzity();
                      
            
            //vyrobi novy obj. Session spusteny test
            //vymaze napred , co je v session
            // remove
            $sessionTestu = new SessionEntity\SessionTestu(); 
           //$sessionT
            $sessionTestu->testUkoncen = \FALSE;  // zde???? 
            $sessionTestu->testZahajen = \TRUE; 

            //---------------------------- vyrobi a sestavi novy aggregate entity Spusteny test aggregate
            $spustenyTestAggregateE = new AggEntity\TestAggregate();                          
           
            $spustenyTestAggregateE->konfiguraceTestu = $konfiguraceTestuE ;    // z routy
            $spustenyTestAggregateE->ticketPouzity =  $ticketPouzityE  ;        // z routy
            $spustenyTestAggregateE->prubehTestu =  $prubehTestuE   ;           // naplneno identifikatorKonfiguraceTestuFk
            $spustenyTestAggregateE->sadaOtazek = $sadaOtazekE  ;               //podle konfigurace
            $spustenyTestAggregateE->ulohy = $arrayUlohyC  ;                    //podle konfigurace a pak ze sady otazek
            $spustenyTestAggregateE->sessionTestu = $sessionTestu  ;            //prazdny                             
        
            return $spustenyTestAggregateE;  
    }
    
    
 
}



//     private function hydrate(
//            AggEntity\SpustenyTestAggregate $spustenyTestAggregateE, 
//                      DbEntity\SpustenyTest $spustenyTestE, 
//                  DbEntity\KonfiguraceTestu $konfiguraceTestuE, 
//                     DbEntity\TicketPouzity $ticketPouzityE,
//                        DbEntity\SadaOtazek $sadaOtazekE,
//                                            $arrayOtazkyC,
//                 SessionEntity\SpustenyTest $sessionSpustenyTest
//                         //VstupniPrikazSpust $vstupniPrikaz = NULL
//            ) {
//                    
//            $spustenyTestAggregateE->spustenyTest = $spustenyTestE;
//            $spustenyTestAggregateE->konfiguraceTestu = $konfiguraceTestuE;  
//            $spustenyTestAggregateE->ticketPouzity = $ticketPouzityE;   
//            $spustenyTestAggregateE->sadaOtazek = $sadaOtazekE;                        
//            $spustenyTestAggregateE->otazky = $arrayOtazkyC;  
//            $spustenyTestAggregateE->sessionSpustenyTest = $sessionSpustenyTest;
//            $spustenyTestAggregateE->vstupniPrikaz = $vstupniPrikaz;
//            
//    }
    

