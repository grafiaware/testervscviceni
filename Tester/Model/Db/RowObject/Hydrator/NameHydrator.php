<?php
namespace Tester\Model\Db\RowObject\Hydrator;

/**
 * Description of NameHydrator
 *
 * @author vlse2610
 */
class NameHydrator implements NameHydratorInterface {
    
    public function hydrate($underscoredName){
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $underscoredName))));
    }

    public function extract($camelCaseName) {                
       //$s2 = strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $camelCaseName));
       return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $camelCaseName));              
    }
}
