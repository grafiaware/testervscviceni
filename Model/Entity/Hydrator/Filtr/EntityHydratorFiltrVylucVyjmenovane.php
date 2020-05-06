<?php
namespace Model\Entity\Hydrator\Filtr;

use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrInterface;

/**
 * Description of EntityHydratorFiltrVylucovaci
 *
 * @author vlse2610
 */
class EntityHydratorFiltrVylucVyjmenovane  implements EntityHydratorFiltrInterface {
    //put your code here
    
    private $seznamVlastnostiZRowO;    //z rowobjectu
    
         
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
        //seznam vlastnosti rowObjekt - seznam vjmenovanych
        //return new ArrayIterator(  );
        
    }
}
