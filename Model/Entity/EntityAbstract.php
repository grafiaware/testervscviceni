<?php
namespace Model\Entity;

use Model\Entity\EntityInterface;
use Model\Entity\Identity\IdentityInterface;

/**
 * Description of TableEntityAbstract
 *
 * @author vlse2610
 */
abstract class EntityAbstract implements EntityInterface {
    /**
     *
     * @var IdentityInterface 
     */
    private $identity;

    public function __construct(IdentityInterface $identity) {
        $this->identity = $identity;        
    }    
    
    public function getIdentity(): IdentityInterface {
        return $this->identity;
    }    
 }
