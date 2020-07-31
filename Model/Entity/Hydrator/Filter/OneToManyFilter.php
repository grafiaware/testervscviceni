<?php
namespace Model\Entity\Hydrator\Filter;

use Model\Entity\Hydrator\Filter\OneToManyFilterInterface;




class OneToManyFilter implements OneToManyFilterInterface {
     /**
     * @var array
     */
    private $poleJmen;    
        
    /**
     * 
     * @param array $poleJmen
     */    
    public function __construct( array $poleJmen ) {
        $this->poleJmen = $poleJmen;        
    }

    
    
    //Pozn. - getIterator vrací iterovatelný objekt.    
    
    public function getIterator() : \Traversable {        
         return new \ArrayIterator( $this->poleJmen );
    }             


    
}
