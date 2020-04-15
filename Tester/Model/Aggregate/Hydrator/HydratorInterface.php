<?php
namespace Tester\Model\Aggregate\Hydrator;

use Tester\Model\Aggregate\Entity\EntityInterface;

/**
 *
 * @author vlse2610
 */
interface HydratorInterface {
    public function hydrate(  RowObjectInterface $entity ,$property,  $value );
    public function extract(  RowObjectInterface $entity, $propertyName ) ;
}
