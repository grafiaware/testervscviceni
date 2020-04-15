<?php
namespace Model\Entity\Hydrator\Filtr;


/**
 *
 * @author vlse2610
 */
interface EntityHydratorFiltrInterface {
// nas rowObject je prepravka na data, vlastnosti ma public, nema set-ry, get-ry
    
    /**
     * Nastavi Seznam jmen vlastností row objectu, ktere budou nastavovany entite metodami (setVlastnostmi)  hydratorem.
     * @param array $poleVlastnosti názvy vlastností
     */
    public function setSeznamVlastnostiZRowOKHydrataciEntity( $poleVlastnosti) ;
    
    /**
     * Nastavi Seznam jmen vlastností entity, ktere budou extrahovany z entity a nastaveny do row objectu (prirazenim)  hydratorem.
     * @param array $poleVlastnosti názvy vlastností
     */
    public function setSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti) ;
    
    
    
    /**
     * Vrací seznam jmen vlastnosti  urcenych  k hydrataci
     *      
     * @return array
     */
    public function getSeznamVlastnostiZRowOKHydrataciEntity(): array;
    
    
    /**
     * Vrací seznam jmen vlastnosti  urcenych  k extrakci    
     * 
     * @return array
     */ 
    public function getSeznamVlastnostiZEntityKExtrakciDoRowO(): array;

    
    public function addSeznamVlastnostiZRowOKHydrataciEntity( $poleVlastnosti );        
    public function addSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti );
    
    
}
