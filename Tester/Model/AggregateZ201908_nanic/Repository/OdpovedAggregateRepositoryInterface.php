<?php
namespace Tester\Model\Aggregate\Repository;

use Tester\Model\Aggregate\Entity as AggEntity;

/**
 * Description of OdpovedRepositoryInterface
 *
 * @author vlse2610
 */
interface OdpovedAggregateRepositoryInterface {
    
    /**
     * 
     * @param type $id
     */
    public function getByPrubehTestuId( $id );
    
       
 
    /**
     *  @param \Tester\Model\Aggregate\Entity\OdpovedAggregate $entity
     *  @param $idPrubehTestu
     */
    public function add (AggEntity\OdpovedAggregate $entity,  $idPrubehTestu   );

    
    
}