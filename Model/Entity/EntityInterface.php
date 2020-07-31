<?php

namespace Model\Entity;

use Model\Entity\Identity\IdentityInterface;

 
/**
 *
 * @author vlse2610
 */
interface EntityInterface {
    
    /**
     * 
     * @return IdentityInterface
     */
    public function getIdentity(): IdentityInterface;
    

}
