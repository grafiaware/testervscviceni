<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;


/**
 *
 * @author vlse2610
 */
interface ZadaniTestuAggregateRepositoryInterface {
    
   // public function get( ) ;    
    
    public function getPodleUidKonfigurace ( $uidKonfiguraceTestu  ) ;
    
    public function add ( AggEntity\ZadaniTestuAggregate $ZadaniTestuAggregateEntity ) ;
            
}
