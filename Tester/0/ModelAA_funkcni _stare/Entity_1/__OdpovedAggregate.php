<?php
namespace Tester\Model\Aggregate\Entity_1;

use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Entity as SessionEntity;

/**
 * Description of odpovedAggregate
 *
 * @author vlse2610
 */
class __OdpovedAggregate implements RowObjectInterface {
     /**
     *   nepouzivame u nas
     */
    public $idOdpovedAggregate;
        
    /**
     * @var DbEntity\RowObjectOdpoved 
     */
    public $odpoved;
        
    /**
     *
     * @var DbEntity\RowObjectOdpovedNaOtazku array of 
     */
    public $odpovediNaOtazky;        
    
    /**
     *
     * @var SessionEntity\SessionTestu 
     */
    public  $sessionTestu;
    
                
    public function __construct(  ) {
        $this->odpoved = new DbEntity\RowObjectOdpoved();
        $this->odpovediNaOtazky = [];
        $this->sessionTestu = new SessionEntity\SessionTestu();  
        
        //$this->idOdpovedAggregate = $this->odpoved->idOdpoved;   //zde neni nic, je ted nove
    }
    
    
    
}
