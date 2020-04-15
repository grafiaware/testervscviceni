<?php
namespace Tester\Model\Aggregate\EntityFactory;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 *
 * @author vlse2610
 */
interface TestAggregateEntityFactoryInterface {
    
    /**
     * 
     * @param type $uidKonfiguraceTestu
     * @param type $identifikatorTicketu
     */
    public function createByKonfigurace ( $uidKonfiguraceTestu, $identifikatorTicketu /*VstupniPrikazSpust $vstupniPrikaz*/ ) : AggEntity\TestAggregate;
    
   
}
