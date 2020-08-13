<?php
namespace Test\IdentityTest;


use PHPUnit\Framework\TestCase;

use Model\Entity\Identity\IdentityInterface;
use Model\Entity\EntityInterface;
use Model\Entity\EntityAbstract;



class IdentityMock_forTET implements IdentityInterface {
    /**
     *
     * @var bool Klíč je generovaný.
     */
    private $isGeneratedKey;       
    /**
     * Pole, které jako hodnoty má názvy(jména) polí částí klíče v asoc. poli keyHash.
     * @param array $attribute
     */
    private $attribute;    
    /**
     * Klíč - asoc.pole dvojic (KeyValue pair) jmeno(casti klice)->hodnota(casti klice).
     * @var array 
     */
    private $keyHash;
    
    
      
    public function __construct ( array $attribute, $isGeneratedKey=FALSE ) /*: IdentityInterface*/ {
        $this->isGeneratedKey = (bool) $isGeneratedKey;
        $this->attribute = $attribute;
//        $this->id = spl_object_hash($this);
//        $this->idMD5 = md5($this->id);
    }    
    public function isGenerated() : bool {
        return $this->isGeneratedKey;
    }       
    public function getKeyAttribute() {
        return $this->attribute;
    }
    public function getKeyHash() {
        return $this->keyHash;
    }  
    public function setKeyHash( array $keyHash ) {
        if ($this->isGeneratedKey) {
            throw new  AttemptToSetGeneratedKeyException('Klíč je generovaný a hodnoty generovaného klíče lze nastavit pouze hydrátorem při čtení z databáze.');           
            //throw new \LogicException('Klíč je generovaný a hodnoty generovaného klíče lze nastavit pouze hydrátorem při čtení z databáze.');
        }
        if($this->attribute != array_keys($keyHash)) {
            throw new MismatchedIndexesToKeyAttributeFieldsException('Jména částí klíče ($keyHash) neodpovídají polím atributu klíče zadaným v konstruktoru.');
        }
        $this->keyHash = $keyHash;
        return $this;
    }    
    public function isEqual( IdentityInterface $identity ) : bool {
        //$a == $b 	Equality 	TRUE if $a and $b have the same key/value pairs. - nezáleží na pořadí - testováno
        //$a === $b 	Identity 	TRUE if $a and $b have the same key/value pairs in the same order and of the same types.)
        return $this->keyHash == $identity->getKeyHash();
    }        
    public function hasEqualAttribute( IdentityInterface $identity ) : bool {
        return $this->attribute == $identity->getKeyAttribute();
    }

}

interface TestovaciEntityInterfaceMock_forTET extends EntityInterface {    

        public function getCeleJmeno();
        public function getPrvekVarchar();
        public function getPrvekChar();
        public function getPrvekText();
        public function getPrvekInteger();
        public function getPrvekDate(): \DateTime;
        public function getPrvekDatetime(): \DateTime;
        public function getPrvekTimestamp(): \DateTime;
        public function getPrvekBoolean();        
        public function setCeleJmeno( string $celeJmeno) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekVarchar($prvekVarchar) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekChar($prvekChar) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekText($prvekText) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekInteger($prvekInteger) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekDate(\DateTime $prvekDate) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekDatetime(\DateTime $prvekDatetime) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekTimestamp(\DateTime $prvekTimestamp) :TestovaciEntityInterfaceMock_forTET;
        public function setPrvekBoolean($prvekBoolean) :TestovaciEntityInterfaceMock_forTET;        
}
class TestovaciEntityMock_forTET  extends EntityAbstract implements TestovaciEntityInterfaceMock_forTET {         
        /**
         *
         * @var string
         */   
        private $celeJmeno;    

        private $prvekChar;
        private $prvekVarchar;    
        private $prvekText;
        private $prvekInteger;    
        private $prvekBoolean;
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

    //----------------------------------------------------- 

        public function getCeleJmeno() : string {
            return $this->celeJmeno;
        }

        public function getPrvekVarchar() : string {
            return $this->prvekVarchar;
        }

        public function getPrvekChar(): string {
            return $this->prvekChar;
        }

        public function getPrvekText()  : string{
            return $this->prvekText;
        }

        public function getPrvekInteger()  {
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
        //-----------------------------------

        public function setCeleJmeno( string $celeJmeno) : TestovaciEntityInterfaceMock_forTET {
           $this->celeJmeno = $celeJmeno;
           return $this;
        }

        public function setPrvekVarchar($prvekVarchar) :TestovaciEntityInterfaceMock_forTET {
            $this->prvekVarchar = $prvekVarchar;       
            return $this;        
        }

        public function setPrvekChar($prvekChar) :TestovaciEntityInterfaceMock_forTET {
            $this->prvekChar = $prvekChar;
            return $this;

        }

        public function setPrvekText($prvekText) :TestovaciEntityInterfaceMock_forTET {
            $this->prvekText = $prvekText;
            return $this;        
        }

        public function setPrvekInteger($prvekInteger) :TestovaciEntityInterfaceMock_forTET{
            $this->prvekInteger = $prvekInteger;
            return $this;       
        }

        public function setPrvekDate(\DateTime $prvekDate) :TestovaciEntityInterfaceMock_forTET{
            $this->prvekDate = $prvekDate;
            return $this;        
        }

        public function setPrvekDatetime(\DateTime $prvekDatetime) :TestovaciEntityInterfaceMock_forTET {
            $this->prvekDatetime = $prvekDatetime;
            return $this;        
        }

        public function setPrvekTimestamp(\DateTime $prvekTimestamp) :TestovaciEntityInterfaceMock_forTET {
            $this->prvekTimestamp = $prvekTimestamp;
            return $this;      
        }

        public function setPrvekBoolean($prvekBoolean) :TestovaciEntityInterfaceMock_forTET{
            $this->prvekBoolean = $prvekBoolean;
            return $this;
        }
}


//----------------------------------------------------------------------------------------------------
/**
 * Description of TestovaciEntityTest
 *
 * @author vlse2610
 */
class TestovaciEntityTest extends TestCase {
    /**
     *
     * @var IdentityInterface
     */
    private $identity;
    
    private $testovaciAttribute;
    private $testovaciKeyHash;
        
    
    public function setUp(): void {
        $this->testovaciKeyHash   = [ 'Klic1' => 'aa', 'Klic2' => 'bb'  ];
        $this->testovaciAttribute = [ 'Klic1' ,'Klic2'  ];               
        $this->identity = new IdentityMock_forTET( $this->testovaciAttribute); //neni generovany klic    
    }
    
    
    public function testConstruct(  ) : void {                          
        $this->assertInstanceOf( TestovaciEntityMock_forTET::class, new TestovaciEntityMock_forTET( $this->identity ));                
    }
    
    
    public function testGetIdentity() {
        $entity = new TestovaciEntityMock_forTET( $this->identity );       
        $this->assertInstanceOf(IdentityInterface::class, $entity->getIdentity());        
    }
    
}
