<?php

namespace Model\Entity\Hydrator;

use Filtr\EntityNDo1HydratorFiltrInterface;

/**
 *
 * @author vlse2610
 */
interface EntityNDo1HydratorInterface {
    
    
     /**
     * Hydratuje objekt entity hodnotami  z $rowObjectu.
     * 
     */
    public function hydrate( EntityInterface $entity, RowObjectInterface $rowObject ): void;
    
    
   
     /**
     * Extrahuje hodnoty z objektu $entity do $rowObjectu.     
     * 
     */
    public function extract ( EntityInterface $entity, RowObjectInterface $rowObject): void;  
    
    
    
   /**
    * 
    * @param EntityHydratorFiltr $entityHydratorFiltr
    * @return void
    */
    public function setFiltr( EntityNDo1HydratorFiltrInterface $entityNDo1HydratorFiltr ) :void ;
    
    /**
     * 
     * @return array¨
     */
    public function getFiltr(  ) :array ;

   
}
    
