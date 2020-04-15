<?php
namespace Tester\Model\Aggregate\Entity_1;

use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Entity as SessionEntity;

/**
 * Description of SpoustenyTest
 *
 * @author vlse2610
 */
class __SpoustenyTestAggregate implements RowObjectInterface {
    /**
     *   nepouzivame, nema u nas smysl
     */
    public $idSpoustenyTestAggregate;
    
    /**
     * @var DbEntity\RowObjectPrubehTestu 
     */
    public  $prubehTestu;
    
    /**
     * @var DbEntity\RowObjectTicketPouzity 
     */
    public  $ticketPouzity; 
       
    /**
     * @var SessionEntity\SessionTestu
     */
    public  $sessionTestu;    
    
    public function __construct() {
        $this->prubehTestu = new DbEntity\RowObjectPrubehTestu();
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();       
        $this->sessionTestu = new SessionEntity\SessionTestu();               
    }        
    
}
