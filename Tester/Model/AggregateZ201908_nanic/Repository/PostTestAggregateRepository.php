<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Repository as AggRepo;
use Tester\Model\Aggregate\Hydrator as AggHydrator;


/**
 * Repository aggregatu PostTestAggregate - objektu aktuálně obsluhovaného testu.
 *
 * @author vlse2610
 */
class PostTestAggregateRepository implements PostTestAggregateRepositoryInterface {
    
    //!!!!!!$this->container = $container; zde v tomto objektu neni a nema byt kontejner !!!!!!    
    
    private    $repoPrubehTestu ;
    private    $repoTicketPouzity ;    
    private    $repoSessionTestu ;        
    private    $hydrator ;    
    
    private   $repoZadaniTestuAggregate;
    
    /* @var $repoOdpovedAggregate AggRepo\OdpovedAggregateRepository */    
    private   $repoOdpovedAggregate;
    
    
    
    public function __construct(     DbRepo\PrubehTestu $repoPrubehTestu,
                                   DbRepo\TicketPouzity $repoTicketPouzity,                                
                               SessionRepo\SessionTestu $repoSessionTestu,             
                          AggHydrator\AggregateHydrator $hydrator,
            
                 AggRepo\ZadaniTestuAggregateRepository $repoZadaniTestuAggegate,
                     AggRepo\OdpovedAggregateRepository $repoOdpovedAggregate
        ) {
       
        $this->repoPrubehTestu = $repoPrubehTestu ;
        $this->repoTicketPouzity = $repoTicketPouzity ;        
        $this->repoSessionTestu = $repoSessionTestu; 
        $this->hydrator = $hydrator;
        
        $this->repoZadaniTestuAggregate = $repoZadaniTestuAggegate;        
        $this->repoOdpovedAggregate = $repoOdpovedAggregate;
    }
    
    
    /**
      *  Vrací z repository aggregátní entitu getTestAggregate vyhledanou podle údaje idprubehTestu .
      * 
      * @param type $idPrubehTestu
      * @return \Tester\Model\Aggregate\Entity\PostTestAggregate
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
        $zadaniTestuAggEntity = $this->repoZadaniTestuAggregate->getPodleUidKonfigurace( $uidKonfiguraceTestu );
        
        $odpovedAggregate = $this->repoOdpovedAggregate->getByPrubehTestuId( $idPrubehTestu );
        //---------------------------
        $postTestAggregateEntity = new AggEntity\PostTestAggregate();   
        $this->hydrator->hydrate  ( $postTestAggregateEntity, "prubehTestu", $prubehTestuE);
        $this->hydrator->hydrate  ( $postTestAggregateEntity, "ticketPouzity", $ticketPouzityE);
        $this->hydrator->hydrate  ( $postTestAggregateEntity, "sessionTestu", $sessionTestuE);
        
        $this->hydrator->hydrate  ( $postTestAggregateEntity, "zadaniTestuAggregate", $zadaniTestuAggEntity);              
        $this->hydrator->hydrate  ( $postTestAggregateEntity, "odpovedAggregate", $odpovedAggregate);
        
        return $postTestAggregateEntity;
    }     
    

    
    /** 
     * Uloží aggregátní entitu PostTestAggregate do repository, tj. do  repository jednotlivých podobjektů 
     * { a doplni vazby = id-cka mezi 'podobjekty' }. ( Do repository TicketPouzity, PrubehTestu, Session.)
     * Důležitá poznámka: do repository Session ulozi idDbEntityPrubehTestu!
     * COCOCOCOC A co odpoved??? -ulozit tady???
     * 
     * @param \Tester\Model\Aggregate\Entity\PostTestAggregate $postTestAggregateEntity
     */
    public function add ( AggEntity\PostTestAggregate $postTestAggregateEntity ) {
        //prirazuje jen vzajemne fk klice, ktere nezna, {vznikaji postupnym ukladanim}
        //ty fk, co zna jiz od zacatku, jsou prirazeny hned na zacatku pri stvoreni
        
        //- do ticket pouzity  zapisovat nepotrebuju
        //$this->repoTicketPouzity->add($postTestAggregateEntity->ticketPouzity);
            
        //- do prubeh testu 
        // id_konfigurace jiz prirazeno hned po stvoreni v controleru Tester po new AggEntity\SpoustenyTestAggregate       
        //$postTestAggregateEntity->prubehTestu->identifikatorTicketuFk = $postTestAggregateEntity->ticketPouzity->identifikatorTicketu;        
        $postTestAggregateEntity->prubehTestu->poleNavic             = "...ukoncen test...";   
  /* */ $this->repoPrubehTestu->insert( $postTestAggregateEntity->prubehTestu);            
           
        //- do entity PrubehTestu se dostane idPrubehTestu  --  pri(po) ulozeni do tabulky insertem   tzn. uz tam je          
            //a to se musi jeste ulozit take do session idPrubehTestu - pro pristi beh skriptu 
            
        //- do session testu
            //TENTO add se dela v pripade update, tak by se tu  do session nemuselo???? ukladat  xxx nebo nevadi to  tu nechat.
        $postTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $postTestAggregateEntity->prubehTestu->idPrubehTestu;
        $this->repoSessionTestu->add($postTestAggregateEntity->sessionTestu);
                
        //- toto  nezapisuji  , neexistuje    $postTestAggregateEntity->zadaniTestuAggregate  
                        
        //- do odpoved aggregatu
        //$postTestAggregateEntity->odpovedAggregate ... se zapisuje aggregat OdpovedAggregate
        $this->repoOdpovedAggregate->add($postTestAggregateEntity->odpovedAggregate, $postTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu );  
        
        
        
        
        //$testAggregateEntity->idTestAggregate = $testAggregateEntity->prubehTestu->idPrubehTestu;   // nema u nas smysl, nemame agregatni id
    }
        
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
    
    