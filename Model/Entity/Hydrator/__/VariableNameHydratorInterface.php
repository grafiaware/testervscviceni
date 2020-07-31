<?php
//namespace Model\Entity\Hydrator;

/**
 *
 * @author vlse2610
 */
interface VariableNameHydratorInterface {
    
    public function hydrate($name): string;
    
    public function extract($name): string;
}

