<?php
namespace Tester\Model\Aggregate\EntityFactory;

use Tester\Model\Aggregate\Entity\OdpovedAggregate;


/**
 *
 * @author vlse2610
 */
interface OdpovedAggregateEntityFactoryInterface {
    /**
     * 
     * @return Tester\Model\Aggregate\Entity\OdpovedAggregate Description
     */
    public function create ( array $vsechnyOdpovedi/*,  $idPrubehTestu*/  ): OdpovedAggregateRepository;
    
    
}  
