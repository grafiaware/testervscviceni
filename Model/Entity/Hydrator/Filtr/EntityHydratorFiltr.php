<?php
namespace Model\Entity\Hydrator\Filtr;

use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrInterface;

/**
 * Description of FiltrHydratoru
 *
 * @author vlse2610
 */
class EntityHydratorFiltr implements EntityHydratorFiltrInterface {    
    /**
     *
     * @var array
     */
    private $seznamVlastnostiZRowOKHydrataciEntity;    //z rowobjectu
    /**
     *
     * @var array
     */
    private $seznamVlastnostiZEntityKExtrakciZEntity;
    
    
        
    public function __construct() {        
    }

        
    /**
     * 
     * @param array $poleVlastnosti  názvy vlastností
     * @return $this
     */
    public function setSeznamVlastnostiZRowOKHydrataciEntity( $poleVlastnosti ) {
        $this->seznamVlastnostiZRowOKHydrataciEntity = $poleVlastnosti;
        return $this;
    }
    /**
     * 
     * @param array $poleVlastnosti názvy vlastností
     * @return $this
     */
    public function setSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti ) {
        $this->seznamVlastnostiZEntityKExtrakciZEntity = $poleVlastnosti;
        return $this;
    }
    
    
    public function getSeznamVlastnostiZRowOKHydrataciEntity() {
        return $this->seznamVlastnostiZRowOKHydrataciEntity;
    }

    
    public function getSeznamVlastnostiZEntityKExtrakciDoRowO() {
        return $this->seznamVlastnostiZEntityKExtrakciZEntity;
    }

    public function addSeznamVlastnostiZRowOKHydrataciEntity( $poleVlastnosti ) {}
        
    public function addSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti )  {}

}
