<?php
namespace Model\Entity\Hydrator;

use Model\Entity\TableEntityInterface;
use Model\RowObject\RowObjectInterface;
use Model\Entity\Hydrator\Filtr\EntityHydratorFiltr;


/**
 *
 * @author vlse2610
 */
interface EntityHydratorInterface {
    
    /**
     * Hydratuje objekt entity hodnotami  z $rowObjectu.
     * 
     */
    public function hydrate( TableEntityInterface $entity, RowObjectInterface $rowObject ): void;
    
    
   
     /**
     * Extrahuje hodnoty z objektu $entity do $rowObjectu.     
     * 
     */
    public function extract ( TableEntityInterface $entity, RowObjectInterface $rowObject): void;  
    
    
    
   /**
    * 
    * @param EntityHydratorFiltr $entityHydratorFiltr
    * @return void
    */
    public function setFiltr(  EntityHydratorFiltr $entityHydratorFiltr ) :void ;
    
    /**
     * 
     * @return array¨
     */
    public function getFiltr(  ) :array ;

   
}