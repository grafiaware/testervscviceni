<?php
namespace Tester\Model\Db\RowObject\Hydrator;

use Tester\Model\Db\RowObject\RowObjectInterface;
use Pes\Database\Metadata\ColumnMetadataInterface;
use Pes\Database\Metadata\TableMetadataInterface;

/**
 * Description of Hydrator
 *
 * @author vlse2610
 */
class HydratorRowObject implements HydratorRowObjectInterface {
    
    private $nameHydrator;
    
    public function __construct(NameHydratorInterface $nameHydrator) {
        $this->nameHydrator = $nameHydrator;
    }
    
    
    public function extract( $propertyName, RowObjectInterface $rowObject, TableMetadataInterface $tableMetaData) {
        $propValue = $rowObject->$propertyName;
        $columnName = $this->nameHydrator->extract($propertyName);            
        $columnMetadata = $tableMetaData->getColumnMetadata($columnName);
        if ( !$columnMetadata) {
            throw new \UnexpectedValueException("Neznámý název sloupce $columnName v tabulce {$tableMetaData->getTableName()}."
            . " Název sloupce byl získán z jména vlastnosti $propertyName row objektu ".get_class($rowObject)."}");
        }
        $colType = $columnMetadata->getType();
        if ($propValue instanceof \Serializable AND ($colType == 'var' OR $colType == 'varchar' OR $colType == 'text')) {
            $ret = serialize($propValue);
        } elseif($propValue instanceof \DateTime) {
            if ($colType == 'datetime' OR $colType=='timestamp') {
                $ret = $propValue->format("Y-m-d H:i:s");
            } elseif ($colType=='date') {
                $ret = $propValue->format("Y-m-d");
            } else {
                $ret = $propValue->format("d.m.Y H:i:s");
            }
        } else {
            $ret = $propValue;
        }
        
        return $ret;
    }

    
    public function hydrate( $value, RowObjectInterface $rowObject, 
                             ColumnMetadataInterface $columnMetadata, TableMetadataInterface $tableMetaData) {
//        //---pridano VS si
//        $propValue = $entity->$propertyName;
//        $columnName = $this->nameHydrator->extract($propertyName);            
//        $columnMetadata = $tableMetaData->getColumnMetadata($columnName);
//         //---pridano - konec
        
        $columnType = $columnMetadata->getType();
        $propertyName = $this->nameHydrator->hydrate($columnMetadata->getName());
       
        switch ($columnType) {
            case 'datetime':
                $datetime = \DateTime::createFromFormat("Y-m-d H:i:s", $value);
                $rowObject->$propertyName = ($datetime !== FALSE) ? $datetime : NULL;
                break;

            case 'var':
            case 'varchar':
            case 'text': 
                if ( $rowObject->$propertyName instanceof \Serializable) {
                     $rowObject->$propertyName = unserialize($value);
                }
                else { $rowObject->$propertyName = $value; }
                break;
            default:
                $rowObject->$propertyName = $value;
                break;
        }
        return $rowObject;
    }
}
