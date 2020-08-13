<?php
namespace Test\IdentityTest;

use PHPUnit\Framework\TestCase;

use Model\Entity\Identity\Identity;
use Model\Entity\Identity\Exception\AttemptToSetGeneratedKeyException;
use Model\Entity\Identity\Exception\MismatchedIndexesToKeyAttributeFieldsException;



/**
 * Description of IdentityTest
 *
 * @author vlse2610
 */
class IdentityTest extends TestCase  {
     
    private  $testovaciAttribute;
    private  $testovaciKeyHash;
        
    
    public function setUp(): void {
        $this->testovaciKeyHash   = [ 'Klic1' => 'aa', 'Klic2' => 'bb'  ];
        $this->testovaciAttribute = [ 'Klic1' ,'Klic2'  ];
    }
    
    
    //-------------------------------------------------------------------------
    public function testIsGenerated(  ) : void {
       $isGenerated = true; 
       $identity = new Identity( $this->testovaciAttribute, $isGenerated);        //na $attribute nezalezi
       $this->assertTrue (  $identity->isGenerated() , '*CH* -  atribut objektu IsGeneratedKey ocekavan TRUE ' );
       $identity = new Identity( $this->testovaciAttribute, false );        
       $this->assertFalse (  $identity->isGenerated());                
       $identity = new Identity( $this->testovaciAttribute );        
       $this->assertFalse (  $identity->isGenerated() , '*CH* - atribut objektu IsGeneratedKey ocekavan FALSE ' );       
    } 
    
    
    public function testGetKeyAttribute() : void {
        $identity = new Identity( $this->testovaciAttribute );  
        $this->assertEquals( $this->testovaciAttribute , $identity->getKeyAttribute());
        $identity = new Identity([]);  
        $this->assertEquals( [] , $identity->getKeyAttribute());        
    }
    
    public function testSetKeyHash( ) : void  {
       $identity = new Identity( $this->testovaciAttribute );            
       $identity->setKeyHash( $this->testovaciKeyHash ) ;                     
       $keyHash = $identity->getKeyHash();    
       
       $this->assertEquals($this->testovaciKeyHash,$keyHash);
    }
    
    public function testSetKeyHash_AttemptToSetGeneratedKeyException( ) : void  {
        $identity = new Identity( $this->testovaciAttribute, \TRUE );             
        $this->expectException( AttemptToSetGeneratedKeyException::class );  
        $identity->setKeyHash( $this->testovaciKeyHash ) ;  //'*CH* pokus o nastaveni klice, ktery je generovany '
    }
    
    public function testSetKeyHash_MismatchedIndexesToKeyAttributeFieldsException() : void  {
        $identity = new Identity( [] );             
        $this->expectException( MismatchedIndexesToKeyAttributeFieldsException::class ); // '*CH* neshodny attribute pri nastavovani klice'
        $identity->setKeyHash( $this->testovaciKeyHash ) ;   // '*CH* neshodny atribut ->attribute objektu Identity pri nastavovani klice'        
    }    

    public function testGetKeyHash( ) : void  {
       $identity = new Identity( $this->testovaciAttribute );            
       $identity->setKeyHash( $this->testovaciKeyHash ) ;                     
       $keyHash = $identity->getKeyHash();    
       $this->assertEquals($this->testovaciKeyHash,$keyHash);
    }    
    
    
    public function testIsEqual(  ) : void  {
        $identity1 = new Identity( $this->testovaciAttribute ); 
        $identity1->setKeyHash($this->testovaciKeyHash);
        $identity2 = new Identity( $this->testovaciAttribute );
        $identity2->setKeyHash( $this->testovaciKeyHash );
        $this->assertTrue( $identity1->isEqual($identity2), '*CH* keyHash ma byt equal, a neni ');
        
        $identity1 = new Identity( $this->testovaciAttribute ); 
        $identity1->setKeyHash ($this->testovaciKeyHash);
        $identity2 = new Identity(  [ 'Klic1' ] );
        $identity2->setKeyHash( [ 'Klic1' => 'aa'  ] );
        $this->assertFalse( $identity1->isEqual($identity2), '*CH* keyHash nema byt equal, a je ');
        
    }   

       
    public function testHasEqualAttribute(  ) : void {
        $identity1 = new Identity( $this->testovaciAttribute ); 
        $identity2 = new Identity( $this->testovaciAttribute );
        $this->assertTrue( $identity1->hasEqualAttribute($identity2), '*CH* attribute ma byt equal, a neni ');
        
        $identity1 = new Identity( $this->testovaciAttribute ); 
        $identity2 = new Identity( [] );
        $this->assertFalse( $identity1->hasEqualAttribute($identity2), '*CH* attribute nema byt equal, a je ');
        
        $identity1 = new Identity( $this->testovaciAttribute ); 
        $identity2 = new Identity(  [ 'Klic1' ] );
        $this->assertFalse( $identity1->hasEqualAttribute($identity2), '*CH* attribute nema byt equal, a je ');
        
        $identity1 = new Identity( ['aaaa', 'bbbb'] ); 
        $identity2 = new Identity(  [ 'bbbb', 'aaaa' ] );
        $this->assertFalse( $identity1->hasEqualAttribute($identity2), '*CH* attribute nema byt equal, a je ');        
    }    
}
