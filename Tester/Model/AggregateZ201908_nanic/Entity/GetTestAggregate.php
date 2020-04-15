<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Entity as SessionEntity;

/**
 * Agregatni struktura GetTestAggregate.
 * Obsahuje udaje z tabulky prubeh_testu, z tabulky ticket_pouzity,  z repository SessionEntity\SessionTestu, 
 * z agregatu ZadaniTestuAggregate.
 * 
 * @author vlse2610
 */
class GetTestAggregate implements RowObjectInterface {
    /**
     *   nepouzivame, nema u nas smysl
     */
    public $idGetTestAggregate;    
    /**
     * @var DbEntity\RowObjectPrubehTestu 
     */
    public  $prubehTestu;    
    /**
     * @var DbEntity\RowObjectTicketPouzity 
     */
    public  $ticketPouzity;     
    //------------------------------------------------------   
    /**
     * @var SessionEntity\SessionTestu
     */
    public  $sessionTestu;      
    /**
     *
     * @var ZadaniTestuAggregate
     */
    public $zadaniTestuAggregate;
    
    
    
    
    
    public function __construct() {
        $this->prubehTestu = new DbEntity\RowObjectPrubehTestu();
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();       
       
        $this->sessionTestu = new SessionEntity\SessionTestu();   
        
        $this->zadaniTestuAggregate = new ZadaniTestuAggregate();   
        
    }        
    
}
