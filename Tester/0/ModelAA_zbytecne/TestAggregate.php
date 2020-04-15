<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Hydrator as AggHydrator;

use Tester\Model\Session\Entity as SessionEntity;
//use Tester\Model\Db\RowObject as DbEntity;

use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\File\Repository as FileRepo;

/**
 * Description of TestAggregate
 *
 * @author vlse2610
 */
class __TestAggregate implements TestAggregateRepositoryInterface {

    private    $repoPrubehTestu ;
    private    $repoTicketPouzity ;
    private    $repoKonfiguraceTestu ;
    private    $repoSadaOtazek;
    private    $repoUlohy;
    private    $repoSessionTestu ;
    private    $hydrator ;

    //!!!!!!$this->container = $container; zde v tomto objektu nema byt kontejner !!!!!!    
    
    public function __construct(     DbRepo\PrubehTestu $repoPrubehTestu,
                                   DbRepo\TicketPouzity $repoTicketPouzity,
                                DbRepo\DaoKonfiguraceTestu $repoKonfiguraceTestu,
                                      DbRepo\SadaOtazek $repoSadaOtazek, 
                                         FileRepo\Ulohy $repoUlohy,
                               SessionRepo\SessionTestu $repoSessionTestu,            
                      AggHydrator\AggregateHydrator $hydrator) {
       
        $this->repoPrubehTestu = $repoPrubehTestu ;
        $this->repoTicketPouzity = $repoTicketPouzity ;
        $this->repoKonfiguraceTestu = $repoKonfiguraceTestu ;
        $this->repoSadaOtazek = $repoSadaOtazek ;
        $this->repoUlohy = $repoUlohy ;
        $this->repoSessionTestu = $repoSessionTestu;          
        $this->hydrator = $hydrator;
    }
    

    /**
     * Vytvoří a vrátí aggregátní entitu TestAggregate právě spuštěného testu - 
     * -  podle udaje idDbEntityPrubehTestu v session (SessionTestu->idDbEntityPrubehTestu).    
     * Z jednotlivých repository "podobjektů" (tj. z tabulek databaze a ze session)
     * vyzvedne hodnoty, tj.entity.
     * Naplni aggregátní entitu (objekt) TestAggregateE a ten vrátí.
     *
     * * ????? kde naplnuje poprve z routy??????
     * ?/////// A naplni ho hodnotami 'podle/z' inicializacni routy ( $idPrubehTestu, $identifikatorTicketu). V session nepredpoklada 'nic'.* 
     *
     * 
     * @return \Tester\Model\Aggregate\Entity\TestAggregate $testAggregateEntity
     * @throws \LogicException
     */
    public function get(  ) {                       
        /* @var $sessionTestuE  SessionEntity\sessionTestu */
        $sessionTestuE = $this->repoSessionTestu->get();       
        $prubehTestuE = $this->repoPrubehTestu->get($sessionTestuE->idDbEntityPrubehTestu);  

        if ($prubehTestuE) {
            $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk); //obj
            $konfiguraceTestuE = $this->repoKonfiguraceTestu->get($prubehTestuE->uidKonfiguraceTestuFk); //obj

            if ($ticketPouzityE AND $konfiguraceTestuE) {
                $sadaOtazekE = $this->repoSadaOtazek->get($konfiguraceTestuE->idSadaUlohFk );      
                $ulohyA = $this->repoUlohy->find($sadaOtazekE->nazevSady);                   

                $testAggregateEntity = new AggEntity\TestAggregate();  
                $this->hydrator->hydrate ( $testAggregateEntity, "prubehTestu", $prubehTestuE);  
                $this->hydrator->hydrate ( $testAggregateEntity, "konfiguraceTestu", $konfiguraceTestuE);
                $this->hydrator->hydrate ( $testAggregateEntity, "ticketPouzity", $ticketPouzityE);
                $this->hydrator->hydrate ( $testAggregateEntity, "sadaOtazek", $sadaOtazekE);
                $this->hydrator->hydrate ( $testAggregateEntity, "ulohy", $ulohyA);
                $this->hydrator->hydrate ( $testAggregateEntity, "sessionTestu", $sessionTestuE);
            }
        }
        else {
             throw new \LogicException('Nenalezen prubehTestu.');
        }        
        //??? se asi zblaznim , ???? ale tady nevytvořil vubec nic 'noveho'
        return $testAggregateEntity;                
    }   
    
 
     
//
    
    /**
     * Uloží aggregaátní entitu repozitory, tj. do  repozitory jednotlivých podobjektů.
     * @param \Tester\Model\Aggregate\Entity\TestAggregate $testAggregateEntity
     */    
    public function add (AggEntity\TestAggregate $testAggregateEntity ){   
        //prirazuje jen vzajemne fk klice, ktere nezna, vznikaji postupnym ukladanim
        //ty fk,  co zna jiz od zacatku, jsou prirazeny hned na zacatku pri stvoreni
        
            //do ticket pouzity
        $this->repoTicketPouzity->insert($testAggregateEntity->ticketPouzity);
            
            //do prubeh testu - id_konfigurace jiz prirazeno hned po stvoreni
        //$testAggregateEntity->prubehTestu->identifikatorKonfiguraceTestuFk = $testAggregateEntity->konfiguraceTestu->uidKonfiguraceTestu;
           //do prubeh testu
        $testAggregateEntity->prubehTestu->identifikatorTicketuFk = $testAggregateEntity->ticketPouzity->identifikatorTicketu;        
        $this->repoPrubehTestu->insert($testAggregateEntity->prubehTestu);            
            //do entity PrubehTestu se dostane idPrubehTestu  --  pri(po) ulozeni do tabulky              
            //a tady se jeste ulozi take do session idPrubehTestu
        
        $testAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $testAggregateEntity->prubehTestu->idPrubehTestu;
        $this->repoSessionTestu->add($testAggregateEntity->sessionTestu);
        
        //$testAggregateEntity->idTestAggregate = $testAggregateEntity->prubehTestu->idPrubehTestu;       // nema u nas smysl
    }     
    

}


//    /**
//     * Naplni hodnoty aggregatu dodane v parametrech.
//     * 
//
//     * @param \Tester\Model\Aggregate\Entity\SpustenyTestAggregate $testAggregateEntity
//     * @param \Tester\Model\Db\RowObject\PrubehTestu $prubehTestuE
//     * @param \Tester\Model\Db\RowObject\KonfiguraceTestu $konfiguraceTestuE
//     * @param \Tester\Model\Db\RowObject\TicketPouzity $ticketPouzityE
//     * @param \Tester\Model\Db\RowObject\SadaOtazek $sadaOtazekE
//     * @param array $arrayOtazky
//     * @param Tester\Model\Session\Entity $sessionTestu   
//     */
//    private function hydrate(
//                    AggEntity\TestAggregate $testAggregateEntity, 
//                       DbEntity\PrubehTestu $prubehTestuE, 
//                  DbEntity\KonfiguraceTestu $konfiguraceTestuE, 
//                     DbEntity\TicketPouzity $ticketPouzityE,
//                        DbEntity\SadaOtazek $sadaOtazekE,
//                                            $arrayOtazky,
//                 SessionEntity\SessionTestu $sessionTestu                      
//            ) {
//                    
//            $testAggregateEntity->prubehTestu = $prubehTestuE;
//            $testAggregateEntity->konfiguraceTestu = $konfiguraceTestuE;  
//            $testAggregateEntity->ticketPouzity = $ticketPouzityE;   
//            $testAggregateEntity->sadaOtazek = $sadaOtazekE;                        
//            $testAggregateEntity->ulohy = $arrayOtazky;  
//            $testAggregateEntity->sessionTestu = $sessionTestu;
//            
//            $testAggregateEntity->idTestAggregate = $testAggregateEntity->prubehTestu->idPrubehTestu;          
//    }
//   