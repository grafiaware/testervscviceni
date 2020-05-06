<?php
namespace Model\Entity\Hydrator\Filtr;

use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrInterface;

/**
 * Description of FiltrHydratoru
 *
 * @author vlse2610
 */
class EntityHydratorFiltrVseVyjmenovane implements EntityHydratorFiltrInterface {    
    /**
     * asi budou jeden
     * @var array
     */
    private $seznamVlastnostiZRowO;    //z rowobjectu
    
    
    
//    /**
//     * asi budou jeden
//     * @var array
//     */
//    private $seznamVlastnostiZEntityKExtrakciZEntity;
    
    
        
    public function __construct() {        
    }

        
    /**
     * 
     * @param array $poleVlastnosti  názvy vlastností
     * @return $this
     */
    public function setSeznamVlastnostiZRowO( $poleVlastnosti ) {
        $this->seznamVlastnostiZRowO = $poleVlastnosti;
        return $this;
    }
    
    public function getIterator() {
        
        return new ArrayIterator( $this->seznamVlastnostiZRowO );
    }
    
    
    
    
//    /**
//     * 
//     * @param array $poleVlastnosti názvy vlastností
//     * @return $this
//     */
//    public function setSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti ) {
//        $this->seznamVlastnostiZEntityKExtrakciZEntity = $poleVlastnosti;
//        return $this;
//    }
//    
//    
//    public function getSeznamVlastnostiZRowOKHydrataciEntity() {
//        return $this->seznamVlastnostiZRowOKHydrataciEntity;
//    }
//
//    
//    public function getSeznamVlastnostiZEntityKExtrakciDoRowO() {
//        return $this->seznamVlastnostiZEntityKExtrakciZEntity;
//    }
//
//    public function addSeznamVlastnostiZRowOKHydrataciEntity( $poleVlastnosti ) {}
//        
//    public function addSeznamVlastnostiZEntityKExtrakciDoRowO( $poleVlastnosti )  {}

}
