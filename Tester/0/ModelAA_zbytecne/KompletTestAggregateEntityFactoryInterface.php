<?php

namespace Tester\Model\Aggregate\EntityFactory;

use Tester\Model\Aggregate\Entity as AggEntity;
use Tester\Model\Prikaz\VstupniPrikazUkaz;

/**
 *
 * @author vlse2610
 */
interface KompletTestAggregateEntityFactoryInterface {
        
     /**
      * 
      * @param type $idPrubehTestu
      * @param type $identifikatorTicketu
      */
     public function __createByPrubeh ( $idPrubehTestu , $identifikatorTicketu /*VstupniPrikazUkaz $vstupniPrikazUkaz*/ ) : AggEntity\KompletTestAggregate;
    
   
}
