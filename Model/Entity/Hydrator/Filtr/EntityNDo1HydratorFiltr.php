<?php
namespace Model\Entity\Hydrator\Filtr;

use Model\Entity\Hydrator\Filtr\EntityNDo1HydratorFiltrInterface;





/**
 *
 * @author vlse2610
 */
class EntityNDo1HydratorFiltr implements EntityNDo1HydratorFiltrInterface {
    /**
     *
     * @var array
     */
    private $seznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity;
        
    /**
     *
     * @var string
     */
    private $jmenoVlastnostiEntity;
    
    
    
    public function setSeznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity( array $seznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity ) {
        $this->seznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity = $seznamVlastnostiZRowOKHydrataciJedneVlastnostiEntity;
        return $this;
    }
   

    public function setJmenoVlastnostiEntity( $jmenoVlastnostiEntity ) {
        $this->jmenoVlastnostiEntity = $jmenoVlastnostiEntity;
        return $this;
    }

//  maji byt  i get -ry ?????

    
}
