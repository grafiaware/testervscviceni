<?php
namespace Tester\Model\Aggregate\Entity_1;

use Tester\Model\Db\RowObject as DbEntity;

/**
 * Description of ZadaniAggregate
 *
 * @author vlse2610
 */
class __ZadaniTestuAggregate implements RowObjectInterface {
    /**
     *   nepouzite, nema u nas smysl
     */
    public $idZadaniTestuAggregate;
    
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
     * 
     */ 
    public function __construct() {

        $this->konfiguraceTestu = new DbEntity\RowObjectKonfiguraceTestu();        
        $this->sadaOtazek = new DbEntity\RowObjectSadaUloh;
        $this->ulohy =   []; 
                  
    }        
    
     
}
