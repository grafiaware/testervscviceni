<?php
/**
 *
 * @author pes2704
 */
interface Accessor_QueryBuilder_QueryBuilderInterface {
    public function build($array);
    public function parse($query);
}
