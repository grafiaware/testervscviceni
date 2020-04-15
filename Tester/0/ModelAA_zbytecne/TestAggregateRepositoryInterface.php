<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 * Description of NovyTestRepositoryInterface
 *
 * @author vlse2610
 */
interface __TestAggregateRepositoryInterface {
    
    
    public function get( ) ;
    

    /**
     * 
     * @param AggEntity\TestAggregate $testAggregateEntity
     */   
    public function add ( AggEntity\TestAggregate $testAggregateEntity ) ;
   
 
}
    
