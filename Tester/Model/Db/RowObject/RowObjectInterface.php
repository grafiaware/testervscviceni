<?php
namespace Tester\Model\Db\RowObject;

/**
 *
 * @author vlse2610
 */
interface RowObjectInterface {
    
    public function setPersisted( bool $isPersisted );
    public function isPersisted();
}
