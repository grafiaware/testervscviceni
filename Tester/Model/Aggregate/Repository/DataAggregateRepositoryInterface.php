<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 * Description of OdpovedRepositoryInterface
 *
 * @author vlse2610
 */
interface DataAggregateRepositoryInterface {
    
    /**
     * 
     * @param type $id
     */
    public function getByPrubehTestuId( $id );
    
       
 
    /**
     *  @param \Tester\Model\Aggregate\Entity\OdpovedAggregate $entity
     *  @param $idPrubehTestu
     */
    public function add ( AggEntity\DataAggregate $dataAggregate /*,  $idPrubehTestu*/   );

    
    
}