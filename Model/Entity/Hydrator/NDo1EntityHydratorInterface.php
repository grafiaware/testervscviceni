<?php

namespace Model\Entity\Hydrator;

use Filtr\EntityHydratorFiltrNDo1Interface;

/**
 *
 * @author vlse2610
 */
interface NDo1EntityHydratorInterface {
    
    
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
    public function setFiltr( EntityHydratorFiltrNDo1Interface $entityNDo1HydratorFiltr ) :void ;
    
    /**
     * 
     * @return array¨
     */
    public function getFiltr(  ) :array ;

   
}
    
