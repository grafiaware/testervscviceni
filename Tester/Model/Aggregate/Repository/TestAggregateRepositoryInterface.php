<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 * Description of OdpovedRepositoryInterface
 *
 * @author vlse2610
 */
interface TestAggregateRepositoryInterface {
    
    
    public function get( );
    
    
    
    /**
     * 
     * @param type $id
     */
    public function getByPrubehTestuId( $id );
    
       
 
    /** 
     */
    public function add ( AggEntity\TestAggregate $testAggregate  /*,  $idPrubehTestu   */);

    
    
}