<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\RowObject as DbEntity;
use Tester\Model\Session\Entity as SessionEntity;

/**
 * Agregatni struktura PostTestAggregate.
 * Obsahuje udaje z tabulky prubeh_testu, z tabulky ticket_pouzity,  z repository SessionEntity\SessionTestu,
 * z agregatu ZadaniTestuAggregate, z agregatu OdpovedAggregate.
 * 
 * @author vlse2610
 */
class xPostTestAggregate implements RowObjectInterface {
    /**
     *   nepouzivame, nema u nas smysl
     */
    public $idPostTestAggregate;    
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
    //-----------------------------------------------------
    /**
     *
     * @var OdpovedAggregate
     */
    public $odpovedAggregate;
        
    
    
    
    public function __construct() {
        $this->prubehTestu = new DbEntity\RowObjectPrubehTestu();
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();       
       
        $this->sessionTestu = new SessionEntity\SessionTestu();   
        
        $this->zadaniTestuAggregate = new ZadaniTestuAggregate(); 
        $this->odpovedAggregate = new OdpovedAggregate;        
    }        
    
}
