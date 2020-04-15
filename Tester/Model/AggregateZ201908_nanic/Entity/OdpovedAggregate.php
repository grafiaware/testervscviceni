<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\RowObject as DbEntity;


/**
 * Agregatni struktura OdpovedAggregate.
 * Obsahuje udaje z tabulek odpoved, odpoved_na_otazku.
 * 
 * @author vlse2610
 */
class OdpovedAggregate implements RowObjectInterface {
     /**
     *   nepouzivame u nas
     */
    public $idOdpovedAggregate;
        
    /**
     * Prislusi k tabulce odpoved. 
     * @var DbEntity\RowObjectOdpoved 
     */
    public $odpoved;
        
    /**
     * Prislusi k tabulce odpoved_na_otazku.  
     * @var DbEntity\RowObjectOdpovedNaOtazku array of 
     */
    public $odpovediNaOtazky;        
    

    
                
    public function __construct(  ) {
        $this->odpoved = new DbEntity\RowObjectOdpoved();
        $this->odpovediNaOtazky = [];     
                
    }
    
    
    
}
