<?php
namespace Tester\Model\Aggregate\EntityFactory;
 
use Tester\Model\Aggregate\Entity\OdpovedAggregate;
use Tester\Model\Session\Repository as SessionRepo;
use Tester\Model\Db\RowObject as DbEntity;


/**
 * Description of OdpovedAggregateEntityFactory
 *
 * @author vlse2610
 */
class __OdpovedAggregateEntityFactory implements OdpovedAggregateEntityFactoryInterface {

    private $repoSessionTestu;     
    private $repoSessionTabbedu;

    public function __construct(     SessionRepo\SessionTestu $repoSessionTestu,                                
                                   SessionRepo\SessionTabbedu $repoSessionTabbedu  ) {                     
         $this->repoSessionTestu = $repoSessionTestu;   
         $this->repoSessionTabbedu = $repoSessionTabbedu;    
    }
  
    
    /**
     * 
     * Vytvori objekt odpoved aggregate s odpovedmi zadanymi uzivatelem v testu (ziskane z tabbedu) a id spusteneho testu (ze sessionTestu ).
     * 
     * @param array $vsechnyOdpovedi
     * 
     * @return Tester\Model\Aggregate\Entity\OdpovedAggregate $novaOdpovedAggregateE
     * @throws \UnexpectedValueException
     */
    public function create ( array $vsechnyOdpovedi  )  : OdpovedAggregate 
    {          
        $sessionTestuEntity = $this->repoSessionTestu->get();  
        $idPrubehTestu =  $sessionTestuEntity->idDbEntityPrubehTestu;
                
        if ( $vsechnyOdpovedi AND $idPrubehTestu ) {                                   
            $odpovediNaOtazkuColl = array();
            //v key jsou identifikatory
            foreach ($vsechnyOdpovedi as $key=>$value) { 
                $odpovedNaOtazku = new DbEntity\RowObjectOdpovedNaOtazku();  
                $odpovedNaOtazku->identifikatorOdpovedi = $key ;
                $odpovedNaOtazku->hodnota = $value ;
/**///                $odpovedNaOtazku->idPrubehTestuFk = $idPrubehTestu;       
                $odpovediNaOtazkuColl[] = $odpovedNaOtazku;
            }                                  
            $odpovedE =  new DbEntity\RowObjectOdpoved();           
            $odpovedE->idPrubehTestuFk = $idPrubehTestu;
           
            $sessionTabbedu = $this->repoSessionTabbedu->get();            
            $odpovedE->sessionTabbedu = $sessionTabbedu;        
            
            //--------------------------------------------------
            $novaOdpovedAggregateE = new OdpovedAggregate();                                   
            $novaOdpovedAggregateE->sessionTestu =  $sessionTestuEntity; 
            $novaOdpovedAggregateE->odpoved = $odpovedE;
            $novaOdpovedAggregateE->odpovediNaOtazky = $odpovediNaOtazkuColl;
                     
            return $novaOdpovedAggregateE; 
        }             
        else {
             throw new \UnexpectedValueException( "Neplatné vstupní parametry (vsechnyOdpovedi/idPrubehTestu)." );
        }                    
    }
    
    
 
    
}
