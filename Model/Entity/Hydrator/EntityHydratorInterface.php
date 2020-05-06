<?php
namespace Model\Entity\Hydrator;

use Model\Entity\EntityInterface;
use Model\RowObject\RowObjectInterface;
use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrVse;

/**
 *
 * @author vlse2610
 */
interface EntityHydratorInterface {   
    /**
     * Hydratuje objekt entity hodnotami  z $rowObjectu.
     * 
     * @param EntityInterface $entity
     * @param RowObjectInterface $rowObject
     * @return void
     */
    public function hydrate( EntityInterface $entity, RowObjectInterface $rowObject ): void;    
    
   
     /**
     * Extrahuje hodnoty z objektu $entity do $rowObjectu. 
      *     
      * @param EntityInterface $entity
      * @param RowObjectInterface $rowObject
      * @return void
      */
    public function extract ( EntityInterface $entity, RowObjectInterface $rowObject): void;      
    
    
   /**
    * 
    * @param EntityHydratorFiltrVse $entityHydratorFiltr
    * @return void
    */
    public function setFiltr( EntityHydratorInterface $entityHydratorFiltr ) :void ;   
}