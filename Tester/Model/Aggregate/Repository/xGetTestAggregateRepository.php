<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Repository as AggRepo;
use Tester\Model\Aggregate\Hydrator as AggHydrator;


/**
 * Repository aggregatu GetTestAggregate - objektu aktuálně obsluhovaného testu.
 *
 * @author vlse2610
 */
class __GetTestAggregateRepository implements GetTestAggregateRepositoryInterface {
    
    //!!!!!!$this->container = $container; zde v tomto objektu neni a nema byt kontejner !!!!!!    
    
    private    $repoPrubehTestu ;
    private    $repoTicketPouzity ;    
    private    $repoSessionTestu ;        
    private    $hydrator ;    
    
    private   $repoZadaniTestuAgg;
    
    public function __construct(     DbRepo\PrubehTestu $repoPrubehTestu,
                                   DbRepo\TicketPouzity $repoTicketPouzity,                                
                               SessionRepo\SessionTestu $repoSessionTestu,             
                          AggHydrator\AggregateHydrator $hydrator,
            
              AggRepo\ZadaniTestuAggregateRepository $repoZadaniTestuAgg
        ) {
       
        $this->repoPrubehTestu = $repoPrubehTestu ;
        $this->repoTicketPouzity = $repoTicketPouzity ;        
        $this->repoSessionTestu = $repoSessionTestu;        
        $this->hydrator = $hydrator;
        
        $this->repoZadaniTestuAgg = $repoZadaniTestuAgg;        
    }
    
    
    /**
      *  Vrací z repository aggregátní entitu getTestAggregate vyhledanou podle údaje idprubehTestu .
      * 
      * @param type $idPrubehTestu
      * @return \Tester\Model\Aggregate\Entity\getTestAggregate
      * @throws \UnexpectedValueException
     */
    public function get( $idPrubehTestu ){  
        
        $prubehTestuE = $this->repoPrubehTestu->get( $idPrubehTestu );
        if (!isset($prubehTestuE)) {
                throw new \UnexpectedValueException( "Neexistuje zadaný prubeh testu. Zadáno idPrubehTestu: $idPrubehTestu.");
        }         
        $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk);       
        $sessionTestuE = $this->repoSessionTestu->get();                
        
        $uidKonfiguraceTestu = $prubehTestuE->uidKonfiguraceTestuFk;
        $zadaniTestuAggEntity = $this->repoZadaniTestuAgg->getPodleUidKonfigurace( $uidKonfiguraceTestu );
        
        //---------------------------
        $getTestAggregateEntity = new AggEntity\GetTestAggregate();   
        $this->hydrator->hydrate  ( $getTestAggregateEntity, "prubehTestu", $prubehTestuE);
        $this->hydrator->hydrate  ( $getTestAggregateEntity, "ticketPouzity", $ticketPouzityE);
        $this->hydrator->hydrate  ( $getTestAggregateEntity, "sessionTestu", $sessionTestuE);
        
        $this->hydrator->hydrate  ( $getTestAggregateEntity, "zadaniTestuAggregate", $zadaniTestuAggEntity);        
        
        return $getTestAggregateEntity;
    }     
    

    
    
    
    
    
//    /**
//      *  Vrací z repository aggregátní entitu getTestAggregate vyhledanou podle údaje idprubehTestu .
//      * 
//      * @param type $idPrubehTestu
//      * @return \Tester\Model\Aggregate\Entity\getTestAggregate
//      * @throws \UnexpectedValueException
//      */
//    public function getPodleIdPrubehuTestu( $idPrubehTestu ){  
//        
//        $prubehTestuE = $this->repoPrubehTestu->get( $idPrubehTestu );
//        if (!isset($prubehTestuE)) {
//                throw new \UnexpectedValueException( "Neexistuje zadaný prubeh testu. Zadáno idPrubehTestu: $idPrubehTestu.");
//        }         
//        $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk);       
//        $sessionTestuE = $this->repoSessionTestu->get();                
//        
//        $uidKonfiguraceTestu = $prubehTestuE->uidKonfiguraceTestuFk;
//        $zadaniTestuAggEntity = $this->repoZadaniTestuAgg->getPodleUidKonfigurace( $uidKonfiguraceTestu );
//        
//        //---------------------------
//        $getTestAggregateEntity = new AggEntity\GetTestAggregate();   
//        $getTestAggregateEntity->prubehTestu = $prubehTestuE;
//        $getTestAggregateEntity->ticketPouzity = $ticketPouzityE;
//        $getTestAggregateEntity->sessionTestu = $sessionTestuE;   
//        
//        $getTestAggregateEntity->zadaniTestuAggregate = $zadaniTestuAggEntity;
//        
//        return $getTestAggregateEntity;
//    }    
//  
//    /**
//     * Vrátí  z repository aggregátní entitu SpoustenyTestAggregate  
//     * vyhledanou  podle udaje idDbEntityPrubehTestu z entity uložené v SessionTestu.
//     *     
//     * @return \Tester\Model\Aggregate\Entity\GetTestAggregate
//     * @throws \UnexpectedValueException
//     */
//    public function getPodleIdPrubehuTestuZSession (  ){  
//        
//        $sessionTestuE = $this->repoSessionTestu->get();    
//        if (!isset( $sessionTestuE ) ) {
//                throw new \UnexpectedValueException( "Neexistuje session. (A mělo by existovat.)");
//        }        
//        $prubehTestuE = $this->repoPrubehTestu->get( $sessionTestuE->idDbEntityPrubehTestu );
//        if (!isset($prubehTestuE)) {
//                throw new \UnexpectedValueException( "Neexistuje zadaný prubeh testu. (Přečteno ze session-idDbEntityPrubehTestu: $sessionTestuE->idDbEntityPrubehTestu.");
//        }                
//        $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk);                         
//       
//        $getTestAggregateEntity = new AggEntity\GetTestAggregate();   
//        $this->hydrator->hydrate  ( $getTestAggregateEntity, "prubehTestu", $prubehTestuE);
//        $this->hydrator->hydrate  ( $getTestAggregateEntity, "ticketPouzity", $ticketPouzityE);
//        $this->hydrator->hydrate  ( $getTestAggregateEntity, "sessionTestu", $sessionTestuE);
//        
//        $getTestAggregateEntity->zadaniTestuAggregat = $zadaniTestuAggEntity; 
//        
//        return $getTestAggregateEntity;
//    }    
//    
    
    
    
    /** 
     * Uloží aggregátní entitu SpoustenyTestAggregate do repository, tj. do  repository jednotlivých podobjektů 
     * { a doplni vazby = id-cka mezi 'podobjekty' }. ( Do repository TicketPouzity, PrubehTestu, Session.)
     * Důležitá poznámka: do repository Session ulozi idDbEntityPrubehTestu!
     * 
     * @param \Tester\Model\Aggregate\Entity\GetTestAggregate $getTestAggregateEntity
     */
    public function add ( AggEntity\getTestAggregate $getTestAggregateEntity ) {
        //prirazuje jen vzajemne fk klice, ktere nezna, {vznikaji postupnym ukladanim}
        //ty fk, co zna jiz od zacatku, jsou prirazeny hned na zacatku pri stvoreni
        
            //do ticket pouzity
        $this->repoTicketPouzity->insert($getTestAggregateEntity->ticketPouzity);
            
            //do prubeh testu 
        // id_konfigurace jiz prirazeno hned po stvoreni v controleru Tester po new AggEntity\SpoustenyTestAggregate       
        $getTestAggregateEntity->prubehTestu->identifikatorTicketuFk = $getTestAggregateEntity->ticketPouzity->identifikatorTicketu;        
        $this->repoPrubehTestu->insert($getTestAggregateEntity->prubehTestu);            
         
            //do entity PrubehTestu se dostane idPrubehTestu  --  pri(po) ulozeni do tabulky              
            //a to musime tady jeste ulozit take do session idPrubehTestu - pro pristi beh skriptu            
            //do session testu
        $getTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $getTestAggregateEntity->prubehTestu->idPrubehTestu;
        $this->repoSessionTestu->add($getTestAggregateEntity->sessionTestu);
                
        
        //$testAggregateEntity->idTestAggregate = $testAggregateEntity->prubehTestu->idPrubehTestu;   // nema u nas smysl, nemame agregatni id
    }
        
}