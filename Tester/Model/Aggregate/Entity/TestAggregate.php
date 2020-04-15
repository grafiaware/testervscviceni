<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\Entity\PrubehTestuEntity ;
use Tester\Model\Session\Entity\SessionTestu ;

/**
 * Agregatni struktura TestAggregate.
 * 
 * @author vlse2610
 */
class TestAggregate implements EntityAggregateInterface {
     /***   nepouzivame u nas */
    public $idTestAggregate;
            
    /**
    * @var PrubehTestuEntity
    */
    public  $prubehTestu;           
    /**
     * @var SessionTestu
     */
    public  $sessionTestu;          
    
  
                
    public function __construct(  ) {
        
        $this->prubehTestu  = new DbEntity\RowObjectPrubehTestu();        
        $this->sessionTestu = new SessionTestu();           
      
    }
    
    
    
}
