<?php
//namespace Model\Entity\Hydrator\NameHydrator;

use Model\Entity\Hydrator\NameHydratorInterface;
/**
 * Description of GetMethodNameHydrator
 *
 * @author vlse2610
 */
class GetMethodNameHydrator implements VariableNameHydratorInterface {
    /**
     * Vrací string $name se zvětšeným prvním znakem  a doplněný vlevo  řetězcem 'get'.
     * @param string $name  - jmeno  ve tvaru jména vlastnosti row objektu, např.: totoJmeno 
     * @return string
     */   
    public function hydrate( string $name ): string{        
        return  'set'. ucfirst( $name ) ;
    }
    
    
    public function extract( string $name ): string{        
        return  'get'. ucfirst( $name ) ;
    }
    
//    /**
//     * ... pro ??
//     * @param string $name
//     * @return string
//     */
//    public function extract( string $name ): string{
//        //...
//        return lcfirst( substr( $name,3,strlen($name)-3 ) ) ;
//    }

    
    }
