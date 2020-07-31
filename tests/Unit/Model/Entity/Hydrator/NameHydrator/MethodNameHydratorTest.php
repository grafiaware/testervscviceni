<?php
use PHPUnit\Framework\TestCase;

use Model\Entity\Hydrator\NameHydrator\MethodNameHydrator;

/**
 * Description of MethodNameHydratorTest
 *
 * @author vlse2610
 */
class MethodNameEntityHydratorTest  extends TestCase {
    
    public function setUp(): void {                
    }
    
    
    
    public function test() : void {                  
        $entityNameHydrator = new MethodNameHydrator( );  
        
        $this->assertIsObject( $entityNameHydrator );
   
    }
    
}
