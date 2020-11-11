<?php
namespace Model\Repository;

use Model\Entity\EntityInterface;
use Model\Entity\Identity\IdentityInterface;


//-------------------------------------------------------------------------------
/**
 *
 * @author vlse2610
 */
interface TestovaciEntityRepositoryInterface {
    
    /**
     * 
     * @param IdentityInterface $identity
     * @return EntityInterface|null
     */
    public function get ( IdentityInterface $identity ): ?EntityInterface;
    
    /**
     * 
     * @param EntityInterface $entity
     * @return void
     */
    public function add( EntityInterface $entity ): void;
    
    
    /**
     * 
     * @param EntityInterface $entity 
     * @return void
     */
    public function remove( EntityInterface $entity  ): void;
}
