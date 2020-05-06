<?php
namespace Model\Entity;

//use Model\Entity\TestovaciTableEntityInterface;
use Model\Entity\EntityAbstract;

/**
 * Description of KonfiguraceTestu 
 * 
 * @author vlse2610
 */
class TestovaciEntity /*implements TestovaciTableEntityInterface */  extends EntityAbstract  {    
    private $uidPrimarniKlicZnaky ;         
    private $prvekVarchar;
    private $prvekChar;
    private $prvekText;
    private $prvekInteger;    
    /**
     *
     * @var \DateTime 
     */
    private $prvekDate;
    /**
     *
     * @var \DateTime 
     */
    private $prvekDatetime;
    /**
     *
     * @var \DateTime 
     */
    private $prvekTimestamp;
    
    private $prvekBoolean;
   //---------------------------------------------------------------------------
    
    
    public function getUidPrimarniKlicZnaky() {
       return $this->uidPrimarniKlicZnaky;
    }

      
    public function getPrvekVarchar() {
        return $this->prvekVarchar;
    }

    public function getPrvekChar() {
        return $this->prvekChar;
    }

    public function getPrvekText() {
        return $this->prvekText;
    }

    public function getPrvekInteger() {
        return $this->prvekInteger;
    }

    public function getPrvekDate(): \DateTime {
        return $this->prvekDate;
    }

    public function getPrvekDatetime(): \DateTime {
        return $this->prvekDatetime;
    }

    public function getPrvekTimestamp(): \DateTime {
        return $this->prvekTimestamp;
    }

    public function getPrvekBoolean() {
        return $this->prvekBoolean;
    }
        
    //--------------------    

    public function setPrvekVarchar($prvekVarchar) {
        $this->prvekVarchar = $prvekVarchar;       
        return $this;        
    }

    public function setPrvekChar($prvekChar) {
        $this->prvekChar = $prvekChar;
        return $this;
        
    }

    public function setPrvekText($prvekText) {
        $this->prvekText = $prvekText;
        return $this;        
    }

    public function setPrvekInteger($prvekInteger) {
        $this->prvekInteger = $prvekInteger;
        return $this;       
    }

    public function setPrvekDate(\DateTime $prvekDate) {
        $this->prvekDate = $prvekDate;
        return $this;        
    }

    public function setPrvekDatetime(\DateTime $prvekDatetime) {
        $this->prvekDatetime = $prvekDatetime;
        return $this;        
    }

    public function setPrvekTimestamp(\DateTime $prvekTimestamp) {
        $this->prvekTimestamp = $prvekTimestamp;
        return $this;      
    }

    public function setPrvekBoolean($prvekBoolean) {
        $this->prvekBoolean = $prvekBoolean;
        return $this;
    }


    
    
    
}

    
