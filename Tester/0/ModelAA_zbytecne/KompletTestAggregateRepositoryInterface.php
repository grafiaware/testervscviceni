<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 *
 * @author vlse2610
 */
interface __KompletTestAggregateRepositoryInterface {
    
    public function get( );
    
    public function add (AggEntity\KompletTestAggregate $kompletTestAggregateEntity );
    
            
}
