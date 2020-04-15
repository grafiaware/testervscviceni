<?php
namespace Model\Entity;

/**
 *
 * @author vlse2610
 */
interface TestovaciTableEntityInterface {
    
 
    public function getUidPrimarniKlicZnaky() ;
      
    public function getPrvekVarchar() ;

    public function getPrvekChar() ;

    public function getPrvekText() ;

    public function getPrvekInteger() ;

    public function getPrvekDate(): \DateTime ;
    
    public function getPrvekDatetime(): \DateTime;    

    public function getPrvekTimestamp(): \DateTime;

    public function getPrvekBoolean() ;
        
    //--------------------    

    public function setPrvekVarchar($prvekVarchar) ;
   
    public function setPrvekChar($prvekChar) ;

    public function setPrvekText($prvekText) ;

    public function setPrvekInteger($prvekInteger);

    public function setPrvekDate(\DateTime $prvekDate);

    public function setPrvekDatetime(\DateTime $prvekDatetime) ;

    public function setPrvekTimestamp(\DateTime $prvekTimestamp);

    public function setPrvekBoolean($prvekBoolean) ;
   
    
}
