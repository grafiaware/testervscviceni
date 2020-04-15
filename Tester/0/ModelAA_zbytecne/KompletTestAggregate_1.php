<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

use Tester\Model\Session\Entity as SessionEntity;
use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\Dao as DbRepo;

use Tester\Model\File\Repository as FileRepo;
//use Tester\Model\Aggregate\Hydrator as AggHydrator;


/**
 * Description of KompletTest
 *
 * @author vlse2610
 */
class __KompletTestAggregate  implements KompletTestAggregateRepositoryInterface {

    private    $repoPrubehTestu ;
    private    $repoTicketPouzity ;
    private    $repoKonfiguraceTestu ;
    private    $repoSadaOtazek;
    private    $repoUlohy;
    
    private    $repoOdpoved;
    private    $repoOdpovedNaOtazku;
    
    private    $repoSessionTestu ;
    private    $repoSessionTabbedu;


    private    $hydrator ;

    public function __construct(     DbRepo\PrubehTestu $repoPrubehTestu,
                                   DbRepo\TicketPouzity $repoTicketPouzity,
                                DbRepo\DaoKonfiguraceTestu $repoKonfiguraceTestu,
                                      DbRepo\SadaOtazek $repoSadaOtazek, 
                                         FileRepo\Ulohy $repoUlohy,
            
                                         DbRepo\Odpoved $repoOdpoved,
                                 DbRepo\OdpovedNaOtazku $repoOdpovedNaOtazku,
                                     
                               SessionRepo\SessionTestu $repoSessionTestu,
                             SessionRepo\SessionTabbedu $repoSessionTabbedu
            
                     // AggHydrator\TestAggregateHydrator $hydrator
            ) {
                    //$this->container = $container; zde v tomto objektu nema byt kontejner !!!!!!
        
        $this->repoPrubehTestu = $repoPrubehTestu ;
        $this->repoTicketPouzity = $repoTicketPouzity ;
        $this->repoKonfiguraceTestu = $repoKonfiguraceTestu ;
        $this->repoSadaOtazek = $repoSadaOtazek ;
        $this->repoUlohy = $repoUlohy ;
      
        $this->repoOdpoved = $repoOdpoved;
        $this->repoOdpovedNaOtazku =  $repoOdpovedNaOtazku;      
        
        $this->repoSessionTestu = $repoSessionTestu ;  
        $this->repoSessionTabbedu = $repoSessionTabbedu;
        
        //$this->hydrator = $hydrator;
    }
    

    /**
     * Vytvori a vrátí KompletTestAggregate entitu.   PODLE SESSION
     * ??????????????????????????     Vraci null, kdyz lze zaroven  rekreatovat spusteny test ze session a vstupni prikaz z requestu.
     * 
     * @return AggEntity\KompletTestAggregate $kompletTestAggregateE
     * @throws \LogicException
     */
    public function get( ) {  // $idKompletTestAggregate JE  NEPOUZITE    
       // MY MAME JEN JEDNO ULOZISTE SESSION/STAV  
            /* @var $sessionTestuE  SessionEntity\sessionTestu */
            $sessionTestuE = $this->repoSessionTestu->get();       
            $prubehTestuE = $this->repoPrubehTestu->get($sessionTestuE->idDbEntityPrubehTestu);  
            
            if ($prubehTestuE) {
                $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk); //obj
                $konfiguraceTestuE = $this->repoKonfiguraceTestu->get($prubehTestuE->uidKonfiguraceTestuFk); //obj

                if ($ticketPouzityE AND $konfiguraceTestuE) {
                    $sadaOtazekE = $this->repoSadaOtazek->get($konfiguraceTestuE->idSadaUlohFk );      

                    $otazkyE = $this->repoUlohy->find($sadaOtazekE->nazevSady); 
                    
                    /* @var $odpovedE  DbEntity\RowObjectOdpoved */                                          
                    $odpovedE = $this->repoOdpoved->getByPrubehTestuId($prubehTestuE->idPrubehTestu);
                    
                    /* @var $kompletTestAggregateE  AggEntity\KompletTestAggregate */
                    $kompletTestAggregateE = new AggEntity\KompletTestAggregate();  

                    $this->hydrate( $kompletTestAggregateE,
                                $prubehTestuE, $konfiguraceTestuE, $ticketPouzityE, 
                                $sadaOtazekE, $otazkyE,                            
                                $odpovedE, /*$odpovediNaOtazkuCol,      */
                           
                                $sessionTestuE );
                }
            }
            else {
                 throw new \LogicException('Nenalezen prubehTestu.');
            }
            
       // }
        return $kompletTestAggregateE;                
    }   
    
 
     

    /**
     * Naplneni hodnot aggregatu po vzyvednuti z uloziste (tj. z tabulek databaze) a ze session
     *  
     * @param \Tester\Model\Aggregate\Entity\KompletTestAggregate $komletTestAggregateE
     * @param \Tester\Model\Db\RowObject\RowObjectPrubehTestu $prubehTestuE
     * @param \Tester\Model\Db\RowObject\RowObjectKonfiguraceTestu $konfiguraceTestuE
     * @param \Tester\Model\Db\RowObject\RowObjectTicketPouzity $ticketPouzityE
     * @param \Tester\Model\Db\RowObject\RowObjectSadaUloh $sadaOtazekE
     * @param type $arrayOtazkyC
     * @param \Tester\Model\Db\RowObject\RowObjectOdpoved $odpovedE
     * @param \Tester\Model\Session\Entity\SessionTabbedu $sessionTabbedu
     * @param \Tester\Model\Session\Entity\SessionTestu $sessionTestu
     */  
    private function hydrate(
             AggEntity\KompletTestAggregate $komletTestAggregateE, 
                       DbEntity\RowObjectPrubehTestu $prubehTestuE, 
                  DbEntity\RowObjectKonfiguraceTestu $konfiguraceTestuE, 
                     DbEntity\RowObjectTicketPouzity $ticketPouzityE,
            
                        DbEntity\RowObjectSadaUloh $sadaOtazekE,
                                            $arrayOtazkyC,                       
                        /* VstupniPrikazSpust $vstupniPrikaz = NULL*/                                     
                           DbEntity\RowObjectOdpoved $odpovedE, 
               //                             $odpovediNaOtazkuCol,            
                     //SessionEntity\SessionTabbedu $sessionTabbedu,
                 SessionEntity\SessionTestu $sessionTestu                     
            ) {
                    
            $komletTestAggregateE->prubehTestu      = $prubehTestuE;
            $komletTestAggregateE->konfiguraceTestu = $konfiguraceTestuE;  
            $komletTestAggregateE->ticketPouzity    = $ticketPouzityE;   
            
            $komletTestAggregateE->sadaUloh = $sadaOtazekE;       
            $komletTestAggregateE->ulohy = $arrayOtazkyC;  
            
            $komletTestAggregateE->odpoved = $odpovedE;
            $komletTestAggregateE->sessionTestu = $sessionTestu;
            
            $komletTestAggregateE->idKompletTestAggregate = $komletTestAggregateE->prubehTestu->idPrubehTestu;                             
            
    }    


    
      /**
     * Uloží sessionTabbedu aggregátní entity kompletTest do repository p, tj. do  repository session..
       * 
     * @param \Tester\Model\Aggregate\Entity\KompletTestAggregate $kompletTestAggregateEntity
     */    
    public function add ( AggEntity\KompletTestAggregate $kompletTestAggregateEntity ){    
//            //do ticket pouzity
//        $this->repoTicketPouzity->add($kompletTestAggregateEntity->ticketPouzity);
//            
//            //do prubeh testu
//        $kompletTestAggregateEntity->prubehTestu->identifikatorKonfiguraceTestuFk = $kompletTestAggregateEntity->konfiguraceTestu->uidKonfiguraceTestu;
//        
//        $kompletTestAggregateEntity->prubehTestu->identifikatorTicketuFk = $kompletTestAggregateEntity->ticketPouzity->identifikatorTicketu;
//        $this->repoPrubehTestu->add($kompletTestAggregateEntity->prubehTestu);            
//            //do entity PrubehTestu se dostane idPrubehTestu  --  pri(po) ulozeni do tabulky              
//            //a tady se jeste ulozi taky do session idPrubehTestu
        
        //$kompletTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $kompletTestAggregateEntity->prubehTestu->idPrubehTestu;
        $kompletTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $kompletTestAggregateEntity->prubehTestu->idPrubehTestu;
        $this->repoSessionTestu->add($kompletTestAggregateEntity->sessionTestu);        
        $this->repoSessionTabbedu->add($kompletTestAggregateEntity->odpoved->sessionTabbedu);
        
        $kompletTestAggregateEntity->idKompletTestAggregate = $kompletTestAggregateEntity->prubehTestu->idPrubehTestu;              
    }     
    
}
