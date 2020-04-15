<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Aggregate\Entity\EntityInterface;
use Tester\Model\Db\RowObject  as DbEntity;
use Tester\Model\File\Entity as FileEntity;
use Tester\Model\Session\Entity as SessionEntity;


/**
 * Vyrobí nový objekt entitu TestAggregate.
 *
 * @author vlse2610
 */
class __TestAggregate implements RowObjectInterface {
    /**
     *   nepouzite, nema u nas smysl
     */
    public $idTestAggregate;
    
    /**
     * @var DbEntity\RowObjectPrubehTestu 
     */
    public  $prubehTestu;
    
    /**
     * @var DbEntity\RowObjectTicketPouzity 
     */
    public  $ticketPouzity; 
    
    /**     
     * @var DbEntity\RowObjectKonfiguraceTestu 
     */
    public  $konfiguraceTestu;
    
    /**
     * Prislusi k tabulce sada_otazek.
     * 
     * @var DbEntity\RowObjectSadaUloh
     */
    public  $sadaOtazek;   
    
    /**
     *
     * @var FileEntity\Otazka array of 
     */
    public $ulohy;
    
    /**
     * @var SessionEntity\SessionTestu
     */
    public  $sessionTestu;   
    
    //---------------------------------------------------------------------------------
    public function __construct() {              
        $this->konfiguraceTestu = new DbEntity\RowObjectKonfiguraceTestu();        //zadani
        $this->sadaOtazek = new DbEntity\RowObjectSadaUloh;
        $this->ulohy =   []; 
        
        $this->prubehTestu = new DbEntity\RowObjectPrubehTestu();                //spousteny test
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();
        $this->sessionTestu = new SessionEntity\SessionTestu();               
    }        
    
}
