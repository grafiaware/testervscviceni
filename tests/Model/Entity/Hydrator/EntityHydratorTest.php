<?php
use PHPUnit\Framework\TestCase;

use Model\Entity\TestovaciEntity;
use Model\Entity\Hydrator\EntityHydrator;
use Model\RowObject\RowObjectInterface;
use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrVse;



/**
* ...Row je 'prepravka na data' plain data object
*
* @author vlse2610
*/
class TestovaciTableRowObject implements RowObjectInterface {   
 //class TestovaciTableRowObject_E implements RowObjectInterface {                 

    public $uidPrimarniKlicZnaky ;         
    public $prvekVarchar;
    public $prvekChar;
    public $prvekText;
    public $prvekInteger;    
    /**
     *
     * @var \DateTime 
     */
    public $prvekDate;
    /**
     *
     * @var \DateTime 
     */
    public $prvekDatetime;
    /**
     *
     * @var \DateTime 
     */
    public $prvekTimestamp;    
    public $prvekBoolean;          
}





/**
 * Description of EntityHydratorTest
 *
 * @author vlse2610
 */
class EntityHydratorTest extends TestCase {
    
    protected $testDateString ;
    protected $testDate ;
    protected $testDateTimeString;
    protected $testDateTime;
    
    protected $poleHodnotRowObjectu;
        
    const HODNOTA_UID_A = "AAA _test_hydrate";
    const HODNOTA_VARCHAR = "VARCHARY varchary _test";
    const HODNOTA_CHAR = "CHARY chary _test";
    const HODNOTA_TEXT = "TEXTY texty _test";
    const HODNOTA_INTEGER =  666;    
    const HODNOTA_BOOLEAN = \TRUE;
    
    const HODNOTA_UID_B = "BBB _test_extract";    
            
    
    
     /**
     * Pred každým testem.
     * @return void
     */
    public function setUp(): void { 
        $this->testDateString = "2010-09-08";
        $this->testDate = DateTime::createFromFormat("Y-m-d", $this->testDateString)->setTime(0,0,0,0); // s "0:0:0:0" je false
        $this->testDateTimeString = "2005-06-07 22:23:24";
        $this->testDateTime = DateTime::createFromFormat("Y-m-d H:i:s", $this->testDateTimeString);

        
        $this->poleHodnotRowObjectu = [
                "uidPrimarniKlicZnaky" => self::HODNOTA_UID_A, 
                "prvekVarchar" => self::HODNOTA_VARCHAR, 
                "prvekChar" => self::HODNOTA_CHAR, 
                "prvekText" => self::HODNOTA_TEXT, 
                "prvekInteger" => self::HODNOTA_INTEGER,    
                "prvekBoolean" => self::HODNOTA_BOOLEAN,  
                "prvekDate" => $this->testDate,             // objekt       
                "prvekDatetime" => $this->testDateTime,     // objekt 
                "prvekTimestamp" => $this->testDateTime     // objekt                 
                ];   
        
    }
    
    
     /**
     * Hydratuji z objektu  TestovaciTableRowObject $testovaciTableRowObject do objektu $testovaciTableEntity.
     */     
    public function testHydrate() : void {  
        // naplneni zdrojoveho rowobjektu
        /** @var TestovaciTableRowObject $testovaciTableRowObject */  
        $testovaciTableRowObject = new TestovaciTableRowObject();             
        foreach ($this->poleHodnotRowObjectu as $key => $value) {
            $testovaciTableRowObject->$key = $this->poleHodnotRowObjectu[ $key ];
        }        
        // nastaveni - filtr k hydrataci 
        $entityHydratorFiltr = new EntityHydratorFiltrVse();        
        $entityHydratorFiltr->setSeznamVlastnostiZRowOKHydrataciEntity( ['prvekChar', 'prvekText', 'prvekVarchar' ] );  //vlastnosti rowobjectu!!!!!
        $entityHydrator = new EntityHydrator( $entityHydratorFiltr );      
        
        $testovaciTableEntity  =  new TestovaciEntity();        
        $entityHydrator->hydrate( $testovaciTableEntity, $testovaciTableRowObject );     
        
        //kontrola hydratace
        $nastaveneKHydrataci = $entityHydratorFiltr->getPoleVlastnostiKHydrataci();
        foreach ( $nastaveneKHydrataci as $key => $value) {
            //ocekavana, aktualni hodnota v entite
            $getMethodName = 'get' . ucfirst($value);
            $this->assertEquals( $this->poleHodnotRowObjectu[ $value ] , $testovaciTableEntity->$getMethodName()  , "CHYBA");
        }
        // $this->assertEquals( $this->poleHodnotObjektuRowObject[ 'prvekChar' ] , $testovaciTableEntity->prvekChar , "CHYBA");
        
        
    }
    //        $testovaciTableRowObject->prvekChar =  $this->poleHodnotObjektuRowObject["prvekChar"];
            //        $testovaciTableRowObject->prvekText  =  $this->poleHodnotObjektuRowObject["prvekText"];
            //        $testovaciTableRowObject->prvekVarchar  =  $this->poleHodnotObjektuRowObject["prvekVarchar"];       
            //        $testovaciTableRowObject->prvekInteger  =  $this->poleHodnotObjektuRowObject[ "prvekInteger"];
            //        $testovaciTableRowObject->prvekDate  =  $this->poleHodnotObjektuRowObject["prvekDate"];
            //        $testovaciTableRowObject->prvekDatetime  =  $this->poleHodnotObjektuRowObject["prvekDatetime"];
            //        $testovaciTableRowObject->prvekTimestamp  =  $this->poleHodnotObjektuRowObject["prvekTimestamp"];        
            //        $testovaciTableRowObject->prvekBoolean  =  $this->poleHodnotObjektuRowObject["prvekBoolean"];        
    
    
    
    
    
     /**
     * Extrahuji z TestaovaciTableRowObjectu $oRow  do pole $row (db dataset).
     */
    public function testExtract(): void { }
    
    
    
    
}
