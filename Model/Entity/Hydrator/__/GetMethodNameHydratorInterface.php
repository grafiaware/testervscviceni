<?php
//namespace __Model\Entity\Hydrator;

/**
 *
 * @author vlse2610
 */
interface GetMethodNameHydratorInterface {
    
    public function hydrate( string $name ): string;
    
    public function extract( string $name ): string;
}
