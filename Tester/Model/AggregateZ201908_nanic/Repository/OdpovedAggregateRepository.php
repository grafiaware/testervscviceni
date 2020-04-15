<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Db\Dao\Odpoved ;
use Tester\Model\Db\Dao\OdpovedNaOtazku ;
use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Hydrator as AggHydrator;



/**
 * Description of OdpovedAggregate
 *
 * @author vlse2610
 */
class   OdpovedAggregateRepository   implements OdpovedAggregateRepositoryInterface{
    private $repoOdpoved;
    private $repoOdpovedNaOtazku;
    
    private $hydrator;
   

   
    /**
     * 
     * @param \Tester\Model\Db\Dao\Odpoved $repoOdpoved
     * @param \Tester\Model\Db\Dao\OdpovedNaOtazku $repoOdpovedNaOtazku     
     * @param \Tester\Model\Aggregate\Hydrator\AggregateHydrator $hydrator
     */
    public function __construct(                Odpoved $repoOdpoved,    
                                        OdpovedNaOtazku $repoOdpovedNaOtazku,
                               
                          AggHydrator\AggregateHydrator $hydrator
                                ) {       
        $this->repoOdpoved = $repoOdpoved;
        $this->repoOdpovedNaOtazku =  $repoOdpovedNaOtazku;
        //$this->repoSessionTestu = $repoSessionTestu;
        $this->hydrator = $hydrator;
    }


    
    /**
     * Vrátí z repository aggregátní entitu OdpovedAggregate (najde podle id entity PrubehTestu)  jiz dříve zapsanou do repository.
     * Z jednotlivých repository "podobjektů" (tj. z tabulek databaze odpoved, odpoved_na_otazku) vyzvedne hodnoty, tj.entity, data. 
     * Naplni aggregátní entitu (objekt) OdpovedAggregate a ten vrátí.
     * 
     * @param type $idPrubehTestu
     * @return \Tester\Model\Aggregate\Entity\OdpovedAggregate $odpovedAggregateE
     */
    public function getByPrubehTestuId( $idPrubehTestu ){
        /* @var $odpovedEntity \Tester\Model\Db\RowObject\RowObjectOdpoved  */
        $odpovedEntity = $this->repoOdpoved->getByPrubehTestuId( $idPrubehTestu ); 
        
        if ( $odpovedEntity ) {
            $odpovediNaOtazkuColl = $this->repoOdpovedNaOtazku->find('id_prubeh_testu_fk = :idPrubehTestuFk', ['idPrubehTestuFk'=>$idPrubehTestu] );
            //$sessionTestuEntity = $this->repoSessionTestu->get();

            if ($odpovedEntity AND $odpovediNaOtazkuColl ) {                     
                $odpovedAggregateE = new AggEntity\OdpovedAggregate( );                
                                                          
                $this->hydrator->hydrate ( $odpovedAggregateE, "odpoved", $odpovedEntity );
                $this->hydrator->hydrate ( $odpovedAggregateE, "odpovediNaOtazky", $odpovediNaOtazkuColl );
                //$this->hydrator->hydrate ( $odpovedAggregateE, "sessionTestu", $sessionTestuEntity );                              
    
                return  $odpovedAggregateE;
            }        
        } 
         //throw new \UnexpectedValueException( "Neexistují odpovědi testu s  idPrubehTestuFk: $id " );
        return ;
    }
    
    
    
    
    
    /**
     *  Ukládá do repository  aggregatu $odpovedAggEntity, tj. odpoved, odpovedi na otazku, 
     * 
     *  @param \Tester\Model\Aggregate\Entity\OdpovedAggregate $odpovedAggEntity
     */    
    public function add ( AggEntity\OdpovedAggregate $odpovedAggEntity, $idPrubehTestu ) {                          
        
            // odpoved                
            //# zkontrolovat zda tam jiz neni stejna odpoved  - protoze kdyz mam dve okna, tak klidne 'nekdy' ulozim 2x,
            // vyreseno: nastaven unique na sloupec_fk v tabulce odpoved
            $odpovedArr = $this->repoOdpovedNaOtazku->find( 'id_prubeh_testu_fk = :idPrubehTestuFk',
                                                          // ['idPrubehTestuFk'=>$odpovedAggEntity->sessionTestu->idDbEntityPrubehTestu] );
                                                           ['idPrubehTestuFk'=>$idPrubehTestu] );
            if ( $odpovedArr ) { // zkontrolovat,ze array (  i  s  jednim clenem ) uz je (get vraci jen 1 vetu, jinak chyba )
                 throw new \UnexpectedValueException( "Odpovědi již uloženy. (Voláte ukládání odpovědi do repository - ale tato odpověď již v repository je.)" );
            }
           
            //#           
            $this->repoOdpoved->insert($odpovedAggEntity->odpoved);
            
            // odpovediNaOtazky      
            foreach ( $odpovedAggEntity->odpovediNaOtazky as $odpovedNaOtazkuE ) {
                //$odpovedNaOtazkuE->idPrubehTestuFk = $odpovedAggEntity->odpoved->idPrubehTestuFk; tady ne, uz nastaveno drive pri vytvareni v Tester->saveOdpoved
                $this->repoOdpovedNaOtazku->insert($odpovedNaOtazkuE);
            }  

                           
    }
    
    
}


//    /**
//     * 
//     * Vraci objekt odpoved aggregate kreatovany z pole odpovedi (ziskane z tabbedu) a id spusteneho testu
//     * 
//     * @param array $vsechnyOdpovedi
//     * @param type $idSpustenyTest
//     * 
//     * @return \Tester\Model\Aggregate\Entity\OdpovedAggregate
//     * @throws \UnexpectedValueException
//     */
//    public function create ( array $vsechnyOdpovedi  ) {  
//        $sessionSpustenyTestEntity = $this->repoSessionStav->get();  
//        $idSpustenyTest =  $sessionSpustenyTestEntity->idDbEntityPrubehTestu;
//                
//        if ($vsechnyOdpovedi AND $idSpustenyTest ) {                                   
//            $aa = array();
//            foreach ($vsechnyOdpovedi as $key=>$value) {
//                $odpovedNaOtazku = new DbEntity\OdpovedNaOtazku();  
//                $odpovedNaOtazku->identifikatorOdpovedi = $key ;
//                $odpovedNaOtazku->hodnota = $value ;
//                $odpovedNaOtazku->idSpustenyTestFk = $idSpustenyTest;       
//                $aa[] = $odpovedNaOtazku;
//            }            
//            $odpovediNaOtazkuC = $aa;
//            
//            $odpovedE =  new DbEntity\Odpoved();
//           
//            $odpovedE->idSpustenyTestFk = $idSpustenyTest;
//        
//            $novaOdpovedAggregateE = new AggEntity\OdpovedAggregate;            
//            $this->hydrate( $novaOdpovedAggregateE, $odpovedE, $odpovediNaOtazkuC ,$sessionSpustenyTestEntity );                               
//        
//        return $novaOdpovedAggregateE; 
//        }             
//        else {
//             throw new \UnexpectedValueException( "Neplatné vstupní parametry (vsechnyOdpovedi)." );
//        }                    
//    }
//    
//    
// 