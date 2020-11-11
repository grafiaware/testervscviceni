<?php
namespace Model\Dao;

use Model\RowData\RowDataInterface;

/**
 *
 * @author pes2704
 */
interface DaoInterface {
    
    public function get( $asocPoleKlic ): ?RowDataInterface ;
    public function insert( RowDataInterface $rowData);
    public function update( RowDataInterface $rowData);
    public function delete( $asocPoleKlic ): void;
}
