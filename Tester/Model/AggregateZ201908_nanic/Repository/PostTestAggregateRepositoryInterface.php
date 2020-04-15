<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;


/**
 *
 * @author vlse2610
 */
interface PostTestAggregateRepositoryInterface {     
    
    public function get( $idPrubehTestu );  
    
//    public function getPodleIdPrubehuTestu ( $idPrubehTestu ) ;  
//    
//    public function getPodleIdPrubehuTestuZSession ( ) ;  
    
    public function add ( AggEntity\PostTestAggregate $postTestAggregateEntity ) ;
    
    
}
