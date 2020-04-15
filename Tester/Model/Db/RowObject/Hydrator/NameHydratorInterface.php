<?php

namespace Tester\Model\Db\RowObject\Hydrator;

/**
 *
 * @author vlse2610
 */
interface NameHydratorInterface {
    public function hydrate($underscoredName);
    public function extract($camelCaseName);
}
