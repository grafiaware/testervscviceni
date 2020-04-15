<?php
namespace Tester\Model\Session\Entity;


/**
 *
 * @author vlse2610
 */
interface EntityInterface {
    
    public function setPersisted( bool $isPersisted );
    
    public function isPersisted();
}
