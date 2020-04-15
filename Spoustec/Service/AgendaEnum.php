<?php

namespace Spoustec\Service;

use Pes\Type\Enum;
/**
 * const PROJEKTOR = 'projektor';
 * const KAMPANE   = 'kampane';
 *
 * @author vlse2610
 */
class AgendaEnum extends Enum {
    const PROJEKTOR = 'projektor';
    const KAMPANE   = 'kampane';
}

//class DbType extends Enum { *     
// *     const MySQL = 'mysql';
// *     const MSSQL = 'mssql';
// * }
// 
// $dbType = new DbType();
// *     $msType = $dbType(DbType::MSSQL)   //OK, vrací hodnotu 'mssql'
