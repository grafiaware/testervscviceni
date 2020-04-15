<?php
/**
 * Description of Framework_Entity_EntityAbstract
 *
 * @author pes2704
 */
abstract class Framework_Entity_EntityAbstract implements Framework_Entity_EntityInterface, \IteratorAggregate {
       
    /**
     * Setter, nastavuje jen hodnoty existujících public vlastností, zamezuje přidání další vlastnosti objektu. 
     * @param string $name
     * @param mixed $value
     * @throws LogicException
     */
    public function __set($name, $value=NULL) {
        if ($this->isPublicProperty($name)) {
            $this->$name = $value;
        } else {
            throw new LogicException('Nelze nastavovat neexistující nebo neveřejnou vlastnost '.$name.' objektu '.get_called_class().'.');
        }
    }
    
    /**
     * Metoda oznámí jestli je vlastnost se zadaným jménem public. Takovou vlastnost lze nastavovate metodou __set (nap $entity->vlastnost = $hodnota;)
     * a hodnotu a název takové vlastnosti vracejí metody getNames(), getValues(), getValuesAssoc a obsahuje ji ietrátor vracený
     * metodou getIterator.
     * 
     * @param type $name
     * @return boolean
     */
    public function isPublicProperty($name) {
        return $this->getIterator()->offsetExists($name) ? TRUE : FALSE;
    }
    
    /**
     * Metoda vrací názvy public vlastností modelu v číselně indexovaném poli.
     * @return array
     */
    public function getNames() {
        return array_keys($this->getValuesAssoc());
    }

    /**
     * Metoda vrací hodnoty public vlastností modelu v číselně indexovaném poli.
     * @return array
     */    
    public function getValues() {
        return array_values($this->getValuesAssoc());
    }
    
    /**
     * Metoda vrací hodnoty a názvy public vlastností modelu jako asociativní pole.
     * @return array
     */    
    public function getValuesAssoc() {
        return call_user_func('get_object_vars', $this);  // vrací viditelné nestatické properties - v tomto případě tedy jen public properties objektu
    }
    
    /**
     * Metoda vrací iterátor obsahující vlastnosti objektu
     * @return \ArrayIterator
     */
    public function getIterator() {
       return new ArrayIterator($this->getValuesAssoc());
    }
}
