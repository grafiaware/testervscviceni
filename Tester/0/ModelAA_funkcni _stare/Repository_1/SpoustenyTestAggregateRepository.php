<?php
namespace Tester\Model\Aggregate\Repository_1;

use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Hydrator as AggHydrator;


/**
 * Aggregat SpoustenyTestAggregate. Objekt aktuálně obsluhovaného testu.
 *
 * @author vlse2610
 */
class __SpoustenyTestAggregateRepository implements SpoustenyTestAggregateRepositoryInterface {
    
    //!!!!!!$this->container = $container; zde v tomto objektu neni a nema byt kontejner !!!!!!    
    
    private    $repoPrubehTestu ;
    private    $repoTicketPouzity ;    
    private    $repoSessionTestu ;    
    
    private    $hydrator ;    
    
    public function __construct(     DbRepo\PrubehTestu $repoPrubehTestu,
                                   DbRepo\TicketPouzity $repoTicketPouzity,                                
                               SessionRepo\SessionTestu $repoSessionTestu,             
                          AggHydrator\AggregateHydrator $hydrator) {
       
        $this->repoPrubehTestu = $repoPrubehTestu ;
        $this->repoTicketPouzity = $repoTicketPouzity ;        
        $this->repoSessionTestu = $repoSessionTestu;        
        $this->hydrator = $hydrator;
    }
    
   
     
    
   
    /**
      *  Vrací z repository aggregátní entitu SpoustenyTest vyhledanou podle údaje idprubehTestu .
      * 
      * @param type $idPrubehTestu
      * @return \Tester\Model\Aggregate\Entity\SpoustenyTestAggregate
      * @throws \UnexpectedValueException
      */
    public function getPodleIdPrubehuTestu( $idPrubehTestu ){  
        
        $prubehTestuE = $this->repoPrubehTestu->get( $idPrubehTestu );
        if (!isset($prubehTestuE)) {
                throw new \UnexpectedValueException( "Neexistuje zadaný prubeh testu. Zadáno idPrubehTestu: $idPrubehTestu.");
        }         
        $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk);       
        $sessionTestuE = $this->repoSessionTestu->get();                
        
        $spoustenyTestAggregateEntity = new AggEntity\SpoustenyTestAggregate();   
        $spoustenyTestAggregateEntity->prubehTestu = $prubehTestuE;
        $spoustenyTestAggregateEntity->ticketPouzity = $ticketPouzityE;
        $spoustenyTestAggregateEntity->sessionTestu = $sessionTestuE;   
        
        return $spoustenyTestAggregateEntity;
    }    
    
    
    
    /**
     * Vrátí  z repository aggregátní entitu SpoustenyTestAggregate  
     * vyhledanou  podle udaje idDbEntityPrubehTestu z entity uložené v SessionTestu.
     *     
     * @return \Tester\Model\Aggregate\Entity\SpoustenyTestAggregate
     * @throws \UnexpectedValueException
     */
    public function getPodleIdPrubehuTestuZSession (  ){  
        
        $sessionTestuE = $this->repoSessionTestu->get();    
        if (!isset( $sessionTestuE ) ) {
                throw new \UnexpectedValueException( "Neexistuje session. (A mělo by existovat.)");
        }        
        $prubehTestuE = $this->repoPrubehTestu->get( $sessionTestuE->idDbEntityPrubehTestu );
        if (!isset($prubehTestuE)) {
                throw new \UnexpectedValueException( "Neexistuje zadaný prubeh testu. (Přečteno ze session-idDbEntityPrubehTestu: $sessionTestuE->idDbEntityPrubehTestu.");
        }                
        $ticketPouzityE = $this->repoTicketPouzity->get($prubehTestuE->identifikatorTicketuFk);                         
       
        $spoustenyTestAggregateEntity = new AggEntity\SpoustenyTestAggregate();   
        $this->hydrator->hydrate  ( $spoustenyTestAggregateEntity, "prubehTestu", $prubehTestuE);
        $this->hydrator->hydrate  ( $spoustenyTestAggregateEntity, "ticketPouzity", $ticketPouzityE);
        $this->hydrator->hydrate  ( $spoustenyTestAggregateEntity, "sessionTestu", $sessionTestuE);
        
        return $spoustenyTestAggregateEntity;
    }    
    
    
    
    
    /** 
     * Uloží aggregátní entitu SpoustenyTestAggregate do repository, tj. do  repository jednotlivých podobjektů 
     * { a doplni vazby = id-cka mezi 'podobjekty' }. ( Do repository TicketPouzity, PrubehTestu, Session.)
     * Důležitá poznámka: do repository Session ulozi idDbEntityPrubehTestu!
     * 
     * @param \Tester\Model\Aggregate\Entity\SpoustenyTestAggregate $spoustenyTestAggregateEntity
     */
    public function add ( AggEntity\SpoustenyTestAggregate $spoustenyTestAggregateEntity ) {
        //prirazuje jen vzajemne fk klice, ktere nezna, {vznikaji postupnym ukladanim}
        //ty fk, co zna jiz od zacatku, jsou prirazeny hned na zacatku pri stvoreni
        
            //do ticket pouzity
        $this->repoTicketPouzity->insert($spoustenyTestAggregateEntity->ticketPouzity);
            
            //do prubeh testu 
        // id_konfigurace jiz prirazeno hned po stvoreni v controleru Tester po new AggEntity\SpoustenyTestAggregate       
        $spoustenyTestAggregateEntity->prubehTestu->identifikatorTicketuFk = $spoustenyTestAggregateEntity->ticketPouzity->identifikatorTicketu;        
        $this->repoPrubehTestu->insert($spoustenyTestAggregateEntity->prubehTestu);            
            //do entity PrubehTestu se dostane idPrubehTestu  --  pri(po) ulozeni do tabulky              
            //a to musime tady jeste ulozit take do session idPrubehTestu - pro pristi beh skriptu            
            //do session testu
        $spoustenyTestAggregateEntity->sessionTestu->idDbEntityPrubehTestu = $spoustenyTestAggregateEntity->prubehTestu->idPrubehTestu;
        $this->repoSessionTestu->add($spoustenyTestAggregateEntity->sessionTestu);
        
        //$testAggregateEntity->idTestAggregate = $testAggregateEntity->prubehTestu->idPrubehTestu;   // nema u nas smysl, nemame agregatni id
    }
        
}