<?php
namespace Tester\Model\Aggregate\Entity;

use Tester\Model\Db\RowObject as DbEntity;

/**
 * Agregatni struktura ZadaniTestuAggregate.
 * Obsahuje udaje z tabulek konfigurace_testu, sada_otazek a souboru .php s polem konkretnich otazek testu.
 *
 * @author vlse2610
 */
class ZadaniTestuAggregate implements RowObjectInterface {
    /**
     *   nepouzite, nema u nas smysl
     */
    public $idZadaniTestuAggregate;
    
    /**     
     * Prislusi k tabulce konfigurace_testu. 
     * @var DbEntity\RowObjectKonfiguraceTestu 
     */
    public  $konfiguraceTestu;    
    /**
     * Prislusi k tabulce sada_otazek.
     * @var DbEntity\RowObjectSadaUloh
     */
    public  $sadaUloh;       
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
