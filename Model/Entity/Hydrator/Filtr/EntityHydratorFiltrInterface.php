<?php
namespace Model\Entity\Hydrator\Filtr;


/**
 *
 * @author vlse2610
 */
interface EntityHydratorFiltrInterface extends \IteratorAggregate{  //+ vzlucov\ci filrt +rowobject do metodz filtru,, ymetodz hzdrate volam metodu filtru ?getIterator
// nas rowObject je prepravka na data, vlastnosti ma public, nema set-ry, get-ry
    
    //Pozn.
    //iterator vraci seznam nazvu vlastnosti rowObjektu a  plati to pro iterator obsahujici vlastnosti co chceme nastavit i ty co chceme vyloucit.
    //getiterator(filtr) 
    
    /**
     * Nastavi Seznam jmen vlastností row objectu, ktere  budou  --setovany entite/extrahovany z entity metodami (set-ry/get-ry)  hydratorem.
     * @param array $poleVlastnosti názvy vlastností
     */
    public function setSeznamVlastnostiZRowO( $poleVlastnosti ) ;
        
    
//    /**
//     * Vrací seznam jmen vlastnosti  urcenych  k akceptovani
//     *      
//     * @return array
//     */
//    public function getSeznamVlastnostiZRowO(): array;
           
    //Vrací vlastnosti, ktere budou nastavoány
    public function getIterator() ;
    
}
