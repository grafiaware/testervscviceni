<?php
namespace Model\Entity\Hydrator\Filtr;

use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrNDo1Interface;



/**
 *
 * @author vlse2610
 */
class EntityHydratorFiltrNDo1 implements EntityHydratorFiltrNDo1Interface {
    /**
     *
     * @var array
     */
    private $seznamVlastnostiZRowO;
        
    /**
     *
     * @var string
     */
    private $jmenoVlastnostiEntity;
    
    

    public function setSeznamVlastnostiZRowO( $poleVlastnosti ) {
        $this->seznamVlastnostiZRowO = $poleVlastnosti;
        return $this;
    }

    public function setJmenoVlastnostiEntity( $jmenoVlastnostiEntity ) {
        $this->jmenoVlastnostiEntity = $jmenoVlastnostiEntity;
        return $this;
    }

    
    
     public function getIterator() {
        
        return new ArrayIterator( $this->seznamVlastnostiZRowO );
    }
    
    
    
    
//  maji byt  i get -ry ?????

    
}
