<?php
/**
 *
 * @author pes2704
 */

interface Framework_Entity_EntityInterface {
    public function isPublicProperty($name);
    public function getValues();
    public function getNames();
    public function getValuesAssoc();        
}
