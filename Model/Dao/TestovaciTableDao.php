<?php
namespace Model\Dao;

use Model\RowObject\TestovaciTableRow;
use Model\RowObject\RowObjectInterface;

//CREATE TABLE `testovaci_table` (
// uid_primarni_klic_znaky  // varchar(10) COLLATE utf8_czech_ci NOT NULL,
// pole_varchar  // varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
// pole_char    // char(255) COLLATE utf8_czech_ci DEFAULT NULL,
// pole_text    // text COLLATE utf8_czech_ci,
// pole_integer  // int(11) DEFAULT NULL,
// pole_date     //date DEFAULT NULL,
// pole_datetime    // datetime DEFAULT NULL,
// pole_timestamp   //  timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
//  PRIMARY KEY (`uid_primarni_klic_znaky`)
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
//   public $uidPrimarniKlicZnaky ;            
//    public $poleVarchar;
//    public $poleChar;
//    public $poleText;
//    public $poleInteger;
//    public $poleDate;
//    public $poleDatetime;
//    public $poleTimestamp;

/**
 * Description of 
 *
 * @author vlse2610
 */
class TestovaciTableDao extends DaoAbstract  {

    /**
     * Metoda get v TestovaciTableDao
     *
     * {@inheritdoc}
     *
     * @param string $uid Identifikátor
     * @return RowObjectInterface|null
     */
    public function get($uid): ?RowObjectInterface {
        $sqlQuery = "SELECT  *  FROM testovaci_table "
                   ."WHERE uid_primarni_klic_znaky = :uid_primarni_klic_znaky";
        $rowObject = $this->selectRowObject( $sqlQuery, ['uid_primarni_klic_znaky'=>$uid], TestovaciTableRow::class);
        return $rowObject;
    }


    /**
     * Metoda find v TestovaciTableDao
     *
     * {@inheritdoc}
     *
     * @param string $sqlTemplateWhere SQL příkaz s placeholdery
     * @param array $poleNahrad Asociativní pole náhrad placeholderů
     * @return RowObjectInterface array of Pole objektů  typu RowObjectInterface (TestovaciTableRow)
     */
    public function find( $sqlTemplateWhere, array $poleNahrad ) {
        $sqlQuery = "SELECT  * "
                   ."FROM testovaci_table". ($sqlTemplateWhere ? ' WHERE ' . $sqlTemplateWhere : '');
        $rowObjects = $this->selectCollection($sqlQuery, $poleNahrad, TestovaciTableRow::class);
                // Entity::class - jazykovy konstrukt tj.string oznacujici jmeno classy
        return $rowObjects;
    }


    /**
     * Metoda save  v TestovaciTableDao
     *
     * {@inheritdoc}
     *
     * @param RowObjectInterface $rowObject
     * @return void
     * @throws \UnexpectedValueException
     */
    public function save( RowObjectInterface $rowObject ): void {
        if ( !($rowObject instanceof  TestovaciTableRow)) {
            throw new \UnexpectedValueException("Nesprávný typ parametru. Má být TestovaciTableRow, je to ". get_class($rowObject)."!");
        }
        if ($rowObject->isPersisted()) {
                $sqlQuery = "UPDATE testovaci_table SET "                       
                        . 'uid_primarni_klic_znaky = :uid_primarni_klic_znaky, ' 
                        . 'poleVarchar = :poleVarchar, '
                        . 'poleChar = :poleChar, '
                        . 'poleText = :poleText, ' 
                        . 'poleInteger = :poleInteger, ' 
                        . 'poleDate = ' . date() . ':, '
                        . 'poleDatetime = ' . datetime() . ':, '                        
                            //'poleTimestamp) '                                            
                        . "WHERE uid_primarni_klic_znaky = :uid_primarni_klic_znaky";
                $this->execUpdate($sqlQuery, $rowObject);
        } else {
                $sqlQuery = "INSERT INTO testovaci_table  "
                  . "( uid_primarni_klic_znaky, poleVarchar, poleChar, poleText, poleInteger, poleDate, poleDatetime)"                        
                  . "VALUES  "
                  . "( :uid_primarni_klic_znaky, :poleVarchar, :poleChar, :poleText, :poleInteger,  date(), datetime() )" ;
                $this->execInsertWithUid($sqlQuery, $rowObject, 'uid_primarni_klic_znaky');
        }
    }


    /**
     * Metoda delete v TestovaciTableDao
     *
     * {@inheritdoc}
     *
     * @param RowObjectInterface $rowObject
     * @return void
     * @throws \UnexpectedValueException
     */
    public function delete( RowObjectInterface $rowObject): void {
        if ( !($rowObject instanceof  TestovaciTableRow)) {
            throw new \UnexpectedValueException("Nesprávný typ parametru. Má být TestovaciTableRow, je to ". get_class($rowObject)."!");
        }
        $sqlQuery = "DELETE FROM testovaci_table " .                  
                    "WHERE uid_primarni_klic_znaky = :uid_primarni_klic_znaky";
        $this->execDelete($sqlQuery, $rowObject);
        //nevrací nic
    }

}


//// pozn. {@inheritdoc}    -  vlozi dlouhy popis z DaoInterface
//CREATE TABLE `testovaci_table` (
//  `uid_primarni_klic_znaky` varchar(10) COLLATE utf8_czech_ci NOT NULL,
//  `pole_varchar` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
//  `pole_char` char(255) COLLATE utf8_czech_ci DEFAULT NULL,
//  `pole_text` text COLLATE utf8_czech_ci,
//  `pole_integer` int(11) DEFAULT NULL,
//  `pole_date` date DEFAULT NULL,
//  `pole_datetime` datetime DEFAULT NULL,
//  `pole_timestamp` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
//  PRIMARY KEY (`uid_primarni_klic_znaky`)
//) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;