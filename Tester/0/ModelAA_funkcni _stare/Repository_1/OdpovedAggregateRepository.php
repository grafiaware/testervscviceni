<?php
namespace Tester\Model\Aggregate\Repository_1;

use Tester\Model\Db\Dao\Odpoved ;
use Tester\Model\Db\Dao\OdpovedNaOtazku ;
use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Aggregate\Hydrator as AggHydrator;
use Tester\Model\Session\Repository as SessionRepo;


/**
 * Description of OdpovedAggregate
 *
 * @author vlse2610
 */
class   __OdpovedAggregateRepository   implements OdpovedAggregateRepositoryInterface{
    private $repoOdpoved;
    private $repoOdpovedNaOtazku;
    private $repoSessionTestu;   
    private $hydrator;
   

   
    /**
     * 
     * @param \Tester\Model\Db\Dao\Odpoved $repoOdpoved
     * @param \Tester\Model\Db\Dao\OdpovedNaOtazku $repoOdpovedNaOtazku
     * @param \Tester\Model\Session\Repository\SessionTestu $repoSessionTestu
     * @param \Tester\Model\Aggregate\Hydrator\AggregateHydrator $hydrator
     */
    public function __construct(                Odpoved $repoOdpoved,    
                                        OdpovedNaOtazku $repoOdpovedNaOtazku,
                               SessionRepo\SessionTestu $repoSessionTestu,
                          AggHydrator\AggregateHydrator $hydrator
                                ) {       
        $this->repoOdpoved = $repoOdpoved;
        $this->repoOdpovedNaOtazku =  $repoOdpovedNaOtazku;
        $this->repoSessionTestu = $repoSessionTestu;
        $this->hydrator = $hydrator;
    }


    
    
    /**
     * Podle id prubehu (spousteneho) testu najde  odpoved jiz zapsanou do repository (aggregat odpoved: odpoved, odpoved_na_otazku, session). 
     * Vraci objekt OdpovedAggregate.
     * 
     * @param type $idPrubehTestu
     * @return \Tester\Model\Aggregate\Entity\OdpovedAggregate
     */
    public function getByPrubehTestuId( $idPrubehTestu ){
        /* @var $odpovedEntity \Tester\Model\Db\RowObject\RowObjectOdpoved  */
        $odpovedEntity = $this->repoOdpoved->getByPrubehTestuId( $idPrubehTestu ); 
        
        if ( $odpovedEntity ) {
            $odpovediNaOtazkuColl = $this->repoOdpovedNaOtazku->find('id_prubeh_testu_fk = :idPrubehTestuFk', ['idPrubehTestuFk'=>$idPrubehTestu] );
            $sessionTestuEntity = $this->repoSessionTestu->get();

            if ($odpovedEntity AND $odpovediNaOtazkuColl ) {                     
                $odpovedAggregateE = new AggEntity\OdpovedAggregate( );                
                                                          
                $this->hydrator->hydrate ( $odpovedAggregateE, "odpoved", $odpovedEntity );
                $this->hydrator->hydrate ( $odpovedAggregateE, "odpovediNaOtazky", $odpovediNaOtazkuColl );
                $this->hydrator->hydrate ( $odpovedAggregateE, "sessionTestu", $sessionTestuEntity );                              
    
                return  $odpovedAggregateE;
            }        
        } 
         //throw new \UnexpectedValueException( "Neexistují odpovědi testu s  idPrubehTestuFk: $id " );
        return ;
    }
    
    
    /**
     *  Ukládá do repozitory části aggregatu $odpovedAggEntity, tj. odpoved, odpoved(i) na otazku, sessionTestu
     * 
     *  @param \Tester\Model\Aggregate\Entity\OdpovedAggregate $odpovedAggEntity
     */    
    public function add ( AggEntity\OdpovedAggregate $odpovedAggEntity ) {                          
        
            // odpoved                
            //# zkontrolovat zda tam jiz neni stejna odpoved  - protoze kdyz mam dve okna, tak klidne 'nekdy' ulozim 2x, vyreseno: nastaven unique na sloupec_fk
            $odpovedArr = $this->repoOdpovedNaOtazku->find( 'id_prubeh_testu_fk = :idPrubehTestuFk',
                                                           ['idPrubehTestuFk'=>$odpovedAggEntity->sessionTestu->idDbEntityPrubehTestu] );
            if ( $odpovedArr ) { // zkontrolovat,ze array ( asi i  s  jednim clenem ) uz je (get vraci jen 1vetu, jinak chyba )
                 throw new \UnexpectedValueException( "Odpovědi již uloženy. (Voláte ukládání odpovědi do repository - ale tato odpověď již v repository je.)" );
            }
            //#           
            $this->repoOdpoved->insert($odpovedAggEntity->odpoved);
            
            // odpovediNaOtazky      
            foreach ( $odpovedAggEntity->odpovediNaOtazky as $odpovedNaOtazkuE ){
                //$odpovedNaOtazkuE->idPrubehTestuFk = $odpovedAggEntity->odpoved->idPrubehTestuFk; tady ne, uz nastaveno drive pri vytvareni v Tester->saveOdpoved
                $this->repoOdpovedNaOtazku->insert($odpovedNaOtazkuE);
            }  

            // a tady do session 
            $this->repoSessionTestu->add($odpovedAggEntity->sessionTestu);                      
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