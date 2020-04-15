<?php
namespace Tester\Model\Aggregate\Repository_1;

use Tester\Model\Aggregate\Entity as AggEntity;


/**
 *
 * @author vlse2610
 */
interface __ZadaniTestuAggregateRepositoryInterface {
    
    public function get( ) ;    
    
    public function getPodleUidKonfigurace ( $uidKonfiguraceTestu  ) ;
    
    public function add ( AggEntity\ZadaniTestuAggregate $ZadaniTestuAggregateEntity ) ;
            
}
