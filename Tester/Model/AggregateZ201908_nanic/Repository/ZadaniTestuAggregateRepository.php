<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\File\Repository as FileRepo;
use Tester\Model\Db\Dao as DbRepo;
use Tester\Model\Aggregate\Hydrator as AggHydrator;


/**
 * Description of ZadaniTestuAggregateRepository
 *
 * @author vlse2610
 */
class ZadaniTestuAggregateRepository implements ZadaniTestuAggregateRepositoryInterface {
    
    //!!!!!!$this->container = $container; zde v tomto objektu neni a nema byt kontejner !!!!!!    
    
    private    $repoKonfiguraceTestu ;
    private    $repoSadaOtazek;
    /**
     *
     * @var FileRepo\Ulohy 
     */
    private    $repoUlohy;
    
    private    $hydrator ;    
    
    
    public function __construct(DbRepo\DaoKonfiguraceTestu $repoKonfiguraceTestu,
                                      DbRepo\SadaOtazek $repoSadaOtazek, 
                                         FileRepo\Ulohy $repoUlohy, 
                              
                      AggHydrator\AggregateHydrator $hydrator)   { 
        
        $this->repoKonfiguraceTestu = $repoKonfiguraceTestu ;
        $this->repoSadaOtazek = $repoSadaOtazek ;
        $this->repoUlohy = $repoUlohy ;       
        
        $this->hydrator = $hydrator;
    }
        
    
//    /**
//     * Nedela nic.
//     */
//    public function get( ) {
//        
//    }  
//    
    
    
    /**
     * Vrátí z repository aggregátní entitu ZadaniTestuAggregate - podle udaje id entity KonfiguraceTestu ( parametr $uidKonfiguraceTestu ).    
     * Z jednotlivých repository "podobjektů" (tj. z tabulek databaze - konfigurace_testu, sada_otazek, popř. datových souborů . php s  polem naplněným daty )
     * vyzvedne hodnoty, tj.entity, data.
     * Naplni aggregátní entitu (objekt) ZadaniTestuAggregate a ten vrátí.
     *
     * @param type $uidKonfiguraceTestu     
     * @return \Tester\Model\Aggregate\Entity\ZadaniTestuAggregate $zadaniTestuAggregateEntity 
     * @throws \UnexpectedValueException
     */    
    public function getPodleUidKonfigurace ( $uidKonfiguraceTestu  ) {                                        
        $konfiguraceTestuE  = $this->repoKonfiguraceTestu->get($uidKonfiguraceTestu);   //$uidKonfiguraceTestu
        if (!isset($konfiguraceTestuE)) {
                throw new \UnexpectedValueException( "Neexistuje zadaná konfigurace testu. Zadáno uid: $uidKonfiguraceTestu.");
        }                            
         
        $sadaOtazekE = $this->repoSadaOtazek->get($konfiguraceTestuE->idSadaUlohFk );   //obj.  
        $ulohyA = $this->repoUlohy->find($sadaOtazekE->nazevSady);                   

        $zadaniTestuAggregateEntity = new AggEntity\ZadaniTestuAggregate();                 
        $this->hydrator->hydrate ( $zadaniTestuAggregateEntity, "konfiguraceTestu", $konfiguraceTestuE);
        $this->hydrator->hydrate ( $zadaniTestuAggregateEntity, "sadaOtazek", $sadaOtazekE);
        $this->hydrator->hydrate ( $zadaniTestuAggregateEntity, "ulohy", $ulohyA);                              
       
        return $zadaniTestuAggregateEntity;                
    }   
    
    
    /**
     * Zatim nezapisujeme. 11.4.2019,12.7.2019
     * Uloží aggregátní entitu ZadaniTestuAggregate do repository, tj. do  repository jednotlivých podobjektů.
     * (do sada otazek, do konfigurace testu)
     * 
     * @param \Tester\Model\Aggregate\Entity\ZadaniTestuAggregate $zadaniTestuAggregateEntity
     */     
    public function add ( AggEntity\ZadaniTestuAggregate $zadaniTestuAggregateEntity ){   
        //prirazuje jen vzajemne fk klice, ktere nezna, (vznikaji postupnym ukladanim)
        //ty fk,  co zna jiz od zacatku, jsou prirazeny hned na zacatku pri stvoreni
        
            // do sada otazek   
        $this->repoSadaOtazek->insert( $zadaniTestuAggregateEntity->sadaUloh );   
            // do konfigurace testu
        $zadaniTestuAggregateEntity->konfiguraceTestu->idSadaUlohFk = $zadaniTestuAggregateEntity->sadaUloh->idSadaUloh;
        $this->repoKonfiguraceTestu->insert( $zadaniTestuAggregateEntity->konfiguraceTestu );   
                  
        //$zadaniTestuAggregateEntity->idZadaniTestuAggregate =       // nema u nas smysl
    }     
    
    
}
