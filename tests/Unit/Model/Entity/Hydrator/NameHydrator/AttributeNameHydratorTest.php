<?php
use PHPUnit\Framework\TestCase;

use Model\Entity\Hydrator\NameHydrator\AttributeNameHydrator;

/**
 * Description of AttributeNameHydratorTest
 *
 * @author vlse2610
 */
class AttributeNameEntityHydratorTest extends TestCase {
    
    public function setUp(): void {                
    }
    
    
    
    public function test() : void {                  
        $entityNameHydrator = new AttributeNameHydrator( );  
        
        $this->assertIsObject( $entityNameHydrator );
   
    }
    
}

