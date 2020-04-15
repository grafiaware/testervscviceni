<?php
namespace Tester\Model\Db\Entity\Hydrator;

use Tester\Model\Db\Entity;

/**
 *
 * @author vlse2610
 */
interface KonfiguraceTestuHydratorInterface {
    
    public function hydrate ( Entity\KonfiguraceTestuEntity $entity, RowObjectKonfiguraceTestu $rowObject);
    public function extract ( Entity\KonfiguraceTestuEntity $entity, RowObjectKonfiguraceTestu $rowObject);
}
