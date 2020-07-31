<?php
//namespace Model\Entity\Hydrator\Filter;

/**
 *
 * @author vlse2610
 */
interface OneToOneExcludeFilterInterface extends \IteratorAggregate {
   

    /**
     * Nastaví seznam jmen a seznam vyloučených jmen.     
     * 
     * @param array $poleJmenVsechna - pole jednoduché - jména vlastnosti row objektu (ziskané z classy) všechna
     * @param array $poleJmen - pole jednoduché - jména vlastností row objektu k vyloučení   
     * @return void
     */       
    public function setConfig(  array $poleJmenVsechna, array $poleJmen ) : void;
    
            

    //Pozn. - getIterator vrací iterovatelný objekt.    
    
    /**    
     * Vrací jména, která budou použita k nastavování/extrahování.
     * @return \Traversable
     */ 
    public function getIterator() : \Traversable ;            
           
}
