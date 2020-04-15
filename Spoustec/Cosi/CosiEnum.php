<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Spoustec\Cosi;

use Pes\Type\Enum;

/**
 * Description of CosiEnum
 *
 * @author vlse2610
 */
class CosiEnum extends Enum {
    const TEST = 'Test ke spuštění';
    const VIDEO = 'Video ke spuštění';
}


//class DbType extends Enum { *     
// *     const MySQL = 'mysql';
// *     const MSSQL = 'mssql';
// * }
// 
// $dbType = new DbType();
// *     $msType = $dbType(DbType::MSSQL)   //OK, vrací hodnotu 'mssql'