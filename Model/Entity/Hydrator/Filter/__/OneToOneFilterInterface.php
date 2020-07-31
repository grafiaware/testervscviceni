<?php
//namespace Model\Entity\Hydrator\Filter;


/**
 *
 * @author vlse2610
 */
interface OneToOneFilterInterface extends \IteratorAggregate{  // ?z metody hydrate volam metodu filtru ?
    
    // náš rowObject je prepravka na data, vlastnosti ma public, nema set-ry, get-ry        
  
    
     /**
     * Nastaví seznam jmen.     
     * 
     * @param array $poleJmen - pole jednoduché ((- jména vlastností row objektu))
     * @return void
     */         
    public function setConfig( array $poleJmen ) : void ;
        
    
    
    //Pozn. -  getIterator vrací iterovatelný objekt.  
    
    /**    
     * Vrací jména, která budou použita k nastavování/extrahování.
     * @return \Traversable
     */
    public function getIterator() : \Traversable;
    
}
