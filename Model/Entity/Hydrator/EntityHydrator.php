<?php
namespace Model\Entity\Hydrator;

use Model\RowObject\RowObjectInterface;

//use Model\Entity\EntityInterface;
use Model\Entity\EntityInterface;
//use Model\Entity\TableEntityAbstract;  ??????

use Model\Entity\Hydrator\Filtr\EntityHydratorFiltrVse;

/**
 * Bezstavový?? hydrátor
 * 
 */
class EntityHydrator implements EntityHydratorInterface {
    
    /**
     * Filtr obsahuje seznam jmen  vlastností rowObjektu k hydrataci/extrakci.
     * @var EntityHydratorFiltrVse
     */   
    private $entityHydratorFiltr;

    
    /**
     * 
     */
    public function __construct (   ) {                    
    }
    
    
    /**
     * Hydratuje objekt $entity hodnotami objektu $rowObject voláním $entity->setter metod.
     * 
     * Neřídí se vlastnostmi entity. Vlastnosti určené k hydrataci (zjistí se z filtru $this->EntityHydratorFiltr) hydratuje.
     * 
     * @param EntityInterface $entity
     * @param RowObjectInterface $rowObject
     * @throws \UnexpectedValueException
     */
    public function hydrate( EntityInterface $entity, RowObjectInterface $rowObject ) {        
//        foreach (get_class_methods(get_class($entity)) as $methodName) {
//            if (strpos($methodName, 'set') === 0) {
//                $entity->$methodName($value);        }     }        
       
        //$poleVlastnostiKHydrataci = $this->entityHydratorFiltr->getSeznamVlastnostiZRowOKHydrataciEntity();

        $jmenoTridy = get_class($entity);
        $jmenoParentTridy = get_parent_class($entity);
        $jmenaMetod = get_class_methods(get_class($entity));
        // $entity prijde (prazdne nenaplnene) s vlastnostmi "naplnenymi" = null
//        foreach (get_class_methods(get_class($entity)) as $methodName) {
//            if (strpos($methodName, 'set') === 0) {
//                
//                if (in_array($nazevVlastnostiEntity, $poleVlastnostiKHydrataci ) ) {
//                 //kdyz je vlastnost entity ve filtru hydratoru povolena k hydratovani, snazim se hydratovat   
//                $entity->$methodName(     );     
//                }       
//            
//            }                
//        //  ========================   ANI ZDALEKA NENI HOTOVE
//        }

//        // $entity prijde (prazdne nenaplnene) s vlastnostmi "naplnenymi" = null
//        $classMethods = get_class_methods(get_class($entity));  //pole názvů metod entity   
//        $poleVlastnostiKHydrataci = $this->entityHydratorFiltr->getPoleVlastnostiKHydrataci();
//        #####
//        $vlastnostiEntity = get_object_vars($entity);
//        foreach ( $vlastnostiEntity  /*$entity*/ as $nazevVlastnostiEntity=>$hodnotaVlastnostiEntity ) {
//            $setMethodName = 'set' . $this->underscoreToPascalCase($nazevVlastnostiEntity); //raz_dva  RazDva, jmeno metody set
//            
//            if (in_array($nazevVlastnostiEntity, $poleVlastnostiKHydrataci ) ) {
//                //kdyz je vlastnost entity ve filtru hydratoru povolena k hydratovani, snazim se hydratovat                    
//                if (in_array( $setMethodName, $classMethods))  {    // a kdyz set metoda v entity existuje                                                                                
//                    $entity->$setMethodName($rowObject->$nazevVlastnostiEntity);
//                } else {   // metoda entity set...vlastnost neexistuje   
//                    throw new \UnexpectedValueException("Entita " .  get_class($entity) .  " nemá metodu $setMethodName ->nelze hydratovat.");
//                }                                 
//            } else {    /* neni chyba,  ...jen nechci hydratovat tuto vlastnost */                 
//            }             
//        }
        
        
    }

    
    
    
    /**
     * Extrahuje hodnoty z objektu $entity voláním $entity->getter metod ---> do objektu $rowObject voláním $rowObject->$setter metod.
     * 
     * Řídí se vlastnostmi entity. 
     * Vlastnosti entity určené k extrahování  (zjistí se z filtru $this->EntityHydratorFiltr) extrahuje.   
     * Hodnotu existující vlastnosti objektu $rowObject přepíše, neexistující vlastnosti $rowObject-u  NEpřidá. 
     * Vlastnosti navíc v objektu $rowObject nevadí ( řídí se vlastnostmi entity ).
     * 
     * @param TableEntityInterface $entity
     * @param RowObjectInterface $rowObject
     * @throws \UnexpectedValueException
     *     
     */
    /**
     * 
     
     */
    public function extract( EntityInterface $entity, RowObjectInterface $rowObject) { 
        
//  ==================   ANI ZDALEKA NENI HOTOVE ================ neexistuji sety gety row objektu!!!!!!!!!!!!!!!!!!
        
//        $classMethodsEntity = get_class_methods(get_class( $entity ));
//        $classMethodsObject = get_class_methods(get_class( $rowObject ));
//        $poleVlastnostiKExtrakci = $this->entityHydratorFiltr->getPoleVlastnostiKExtrakci();
//        #####
//        foreach ( $entity as $nazevVlastnostiEntity=>$hodnotaVlastnostiEntity ) {    // vsechny názvy metod entity
//            // z entity stehuju do $rowObject
//            $getMethodName = 'get' . $this->underscoreToPascalCase($nazevVlastnostiEntity); //raz_dva  RazDva, jmeno metody get
//            $setMethodName = 'set' . $this->underscoreToPascalCase($nazevVlastnostiEntity);
//            
//            if (in_array($nazevVlastnostiEntity, $poleVlastnostiKExtrakci ) ) {
//                //kdyz je vlastnost entity ve filtru hydratoru povolena k extrakci, snazim se extrahovat                  
//                if (in_array( $getMethodName, $classMethodsEntity))  {    // a kdyz get metoda v entity existuje                                                                                
//                   $hodnotaVlastnostiEntity = $entity->$getMethodName( ); //hodnota k extrakci do rowObjectu
//                   // $hodnotaVlastnostiEntity
//                   if (in_array( $setMethodName, $classMethodsObject) ) { // a kdyz set metoda v rowObject existuje                        
//                           $rowObject->$setMethodName ( $hodnotaVlastnostiEntity );
//                   }
//                   else {
//                       //neexistuje set metoda objektu $rowObject -- tak nic neprida --OK
//                   }                                                         
//                } else {   // metoda entity get...vlastnosti neexistuje   
//                    throw new \UnexpectedValueException("Entita " .  get_class($entity) .  " nemá metodu $getMethodName ->nelze extrahovat.");
//                } 
//                                
//            }else {    /* neni chyba,  ...jen nechci hydratovat tuto vlastnost */                 
//            } 
            
         // PRAVDY   
         //rowObject ma public vlastnosti !!!!!!!!
         //entity    ma private vlastnosti a set-get-ry  
//        }
    }
   // (pozn. $data[NULL] -> offsetSet(index, NULL) ....
            
    
    private function camelCaseToUnderscore($camelCaseName) {
        $pom = strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $camelCaseName));
        return strtolower(preg_replace('/(?<!^)([A-Z])/', '_$1', $camelCaseName));  // RazDva -> raz_dva
    }

    private function underscoreToPascalCase($underscoredName){   // první písmeno velké  // raz_dva -> RazDva
        $pom = str_replace(' ', '', ucwords(str_replace('_', ' ', $underscoredName)));
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $underscoredName)));
    }
    
    
   
    /**
     * 
     * @param EntityHydratorFiltrVse $entityHydratorFiltr
     */
    public function setFiltr(  EntityHydratorFiltrVse $entityHydratorFiltr ) {
        $this->entityHydratorFiltr = $entityHydratorFiltr;
    }
    
    
    
}



// smazat
//    /**
//     * Hydratuje $entity  voláním setter metod .
//     * Pokud data s příslušným indexem neexistují setter nevolá.   --- řídí se vlastnostmi rowObjectu
//     *     
//     */
//    public function hydrate(  EntityInterface $entity, RowObjectInterface $data ){
//        $classMethods = get_class_methods(get_class($entity));  //pole názvů metod
//        
//        foreach ($data as $key => $value) {
//            $methodName = 'set'. $this->underscoreToPascalCase($key);
//            if (array_key_exists($methodName, $classMethods)) {
//                $entity->$methodName($value);
//            } else {
//                throw new \UnexpectedValueException("Nelze použít data RowData objektu s indexem $key, entita nemá metodu $methodName.");
//            }
//        }
//    }

//   /???
//            if (strpos($methodName, 'get') === 0) {
//                $nazevVlastnosti = substr( $methodName, 3 );                   // setRazDva -> RazDva
//                $value = $entity->$methodName();  //hodnota vybrana z entity  getterem
//                
//                $vlastnost = $this->camelCaseToUnderscore($nazevVlastnosti);   // RazDva -> raz_dva
//                // když getter nevrací nic - nechám to na RowObjektu objektu 
//                $rowObject[ $this->camelCaseToUnderscore($nazevVlastnosti) ] = $value; 
//            }
            