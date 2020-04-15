<?php
/**
 * Description of HttpQueryBuilder
 *
 * @author pes2704
 */
class Accessor_QueryBuilder_HttpQueryBuilder implements Accessor_QueryBuilder_QueryBuilderInterface {
    public function build($array) {
        return http_build_query($array);
    }
    
    public function parse($query) {
        parse_str($query, $array);
        return $array;
    }
}
