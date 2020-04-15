<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\RowObject as DbEntity;
//use Tester\Model\Session\Entity as SessionEntity;

/**
 * Agregatni struktura DataAggregate.
 * Obsahuje udaje vsechna data potrebny pro beh skriptu.
 * 
 * 
 * @author vlse2610
 */
class DataAggregate implements RowObjectInterface {
    public $idDataAggregate; 
    
    
    /**
     * @var DbEntity\RowObjectTicketPouzity 
     */
    public  $ticketPouzity;     
    
    /**
     *
     * @var ZadaniTestuAggregate
     */
    public $zadaniTestuAggregate;
    
     /**
     *
     * @var TestAggregate  
     */
    public $testAggregate;
    
    
    
    
    public function __construct() {
       
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();                              
        $this->zadaniTestuAggregate = new ZadaniTestuAggregate();  
        $this->testAggregate = new TestAggregate();
        
    }        
    
}
