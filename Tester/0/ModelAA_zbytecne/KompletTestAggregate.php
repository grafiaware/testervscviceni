<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Aggregate\Entity\EntityInterface;
use Tester\Model\Db\RowObject  as DbEntity;
use Tester\Model\File\Entity as FileEntity;
use Tester\Model\Session\Entity as SessionEntity;

  
/**
 * Vyrobí nový objekt entitu  KompletTestAggregate.
 */ 
class __KompletTestAggregate implements RowObjectInterface {
    /**
     *   nepouzite, nema u nas smysl
     */
    public $idKompletTestAggregate;
    
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
     * @var DbEntity\RowObjectOdpoved 
     */  
    public $odpoved;  //tady je sessionTabbedu
        
    /**
     *
     * @var DbEntity\RowObjectOdpovedNaOtazku array of 
     */
    public $odpovediNaOtazky;        
       
    /**
     * @var SessionEntity\SessionTestu
     */
    public  $sessionTestu;    
    
//    /**
//    *
//    * @varSessionEntity\SessionTabbedu 
//    */
//    public $sessionTabbedu;
    

    //---------------------------------------------------------------------------------
    public function __construct() {
        $this->prubehTestu = new DbEntity\RowObjectPrubehTestu();
        $this->ticketPouzity = new DbEntity\RowObjectTicketPouzity();
        $this->konfiguraceTestu = new DbEntity\RowObjectKonfiguraceTestu();
        
        $this->sadaOtazek = new DbEntity\RowObjectSadaUloh;
        $this->ulohy =   [];        
        
        $this->odpoved = new DbEntity\RowObjectOdpoved();
        $this->odpovediNaOtazky = [];
        
        $this->sessionTestu = new SessionEntity\SessionTestu();                 
        
    }        
    
}


