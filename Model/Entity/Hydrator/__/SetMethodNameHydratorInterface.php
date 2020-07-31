<?php
//namespace Model\Entity\Hydrator;

/**
 *
 * @author vlse2610
 */
interface SetMethodNameHydratorInterface {
    
    public function hydrate( string $name ) : string;
    
    public function extract( string $name ) : string;
}
