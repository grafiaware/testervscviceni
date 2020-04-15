<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CoBudeVHydratoru
 *
 * @author vlse2610
 */
class CoBudeVHydratoru {
                if (isset($propertyValue) AND $propertyValue instanceof \Serializable) {  // null je vždy serializable
                    $row[$columnName] = serialize($propertyValue);
                } else {
                    
                    
            if ($columnType == 'char' OR $columnType == 'varchar' OR $columnType == 'text') {
                if ( $rowObject->$propertyName instanceof \Serializable) {
                     $rowObject->$propertyName = unserialize($columnValue);
                } else {
                    $rowObject->$propertyName = $columnValue;
                }
            } else
                }
}


//------------------------------------------------------------------
  
    public function getIterator() {
        return new \ArrayIterator(get_object_vars());
    }