<?php


/**
 * vysvětlivka: One - počet vlastností entity, N - popčet vlastností row objektu
 * 
 * @author vlse2610
 */
interface OneToManyFilterInterface extends \IteratorAggregate{ 
           
    // nas rowObject je prepravka na data, vlastnosti ma public, nema set-ry, get-ry        
  
    /**
     * Nastaví seznam(-y) jmen pro metody entity. A nastaví seznam(-y) jmen vlastností row objectu,
     * kterými bude hydratována entity/které budou extrahovány z entity metodami (set-ry/get-ry), a to v hydrátoru.       
     *       
     * @param array $poleJmen   pole[ jméno pro metodu entity ] -> pole[] - jména vlastnosti row objektu
     */       
    public function setConfig( array $poleJmen ) : void ;
        
    
    //Pozn.
    //getIterator vrací iterovatelný objekt.    
    
    /**    
     * Vrací jména, která budou použita k nastavování/extrahování.
     * @return \Traversable
     */
    public function getIterator() : \Traversable;
    
}
