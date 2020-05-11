<?php

namespace Model\Entity\Hydrator\Filtr;

/**
 *
 * @author vlse2610
 */
interface EntityHydratorFiltrNDo1Interface extends EntityHydratorFiltrInterface {
           
    
//    public function setSeznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity(  array $seznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity ) ;
//       
    
    public function setJmenoVlastnostiEntity($jmenoVlastnostiEntity)  ;


    //Vrací vlastnosti, ktere budou nastavoány
    public function getIterator() ;
    
    
    
    //  maji byt  i get -ry ?????
}
