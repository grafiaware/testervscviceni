<?php
namespace Tester\Model\Aggregate\Repository_1;

use Tester\Model\Aggregate\Entity as AggEntity;


/**
 *
 * @author vlse2610
 */
interface __SpoustenyTestAggregateRepositoryInterface {       
    
    public function getPodleIdPrubehuTestu ( $idPrubehTestu ) ;  
    
    public function getPodleIdPrubehuTestuZSession ( ) ;  
    
    public function add ( AggEntity\SpoustenyTestAggregate $SpoustenyTestAggregateEntity ) ;
    
    
}
