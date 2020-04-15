<?php
namespace Tester\Model\Db\RowObject\Hydrator;

use Tester\Model\Db\RowObject\RowObjectInterface;
use Pes\Database\Metadata\ColumnMetadataInterface;
use Pes\Database\Metadata\TableMetadataInterface;
/**
 *
 * @author vlse2610
 */
interface HydratorRowObjectInterface {
    
    public function extract( $propertyName, RowObjectInterface $rowObject, TableMetadataInterface $tableMetaData) ;
    public function hydrate( $value, RowObjectInterface $rowObject, 
                             ColumnMetadataInterface $columnMetadata /*nebude*/, TableMetadataInterface $tableMetaData);
}
