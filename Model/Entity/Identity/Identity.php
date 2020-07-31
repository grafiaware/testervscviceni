<?php
namespace Model\Entity\Identity;

use Model\Entity\Identity\IdentityInterface;
use Model\Entity\Identity\Exception\MismatchedIndexesToKeyAttributeFieldsException;
use Model\Entity\Identity\Exception\AttemptToSetGeneratedKeyException;

/**
 * Description of RelationKey
 *
 * @author pes2704
 */
class Identity implements IdentityInterface, \Serializable {
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

   
    /**
     * V konstruktoru nastaví parametry objektu Identity.
     * 
     * @param array $attribute - pole názvů částí klíče
     * @param bool $isGeneratedKey - zda se jedná o klíč generovaný (nepovinný parametr)
     */    
    public function __construct ( array $attribute, $isGeneratedKey=FALSE ) /*: IdentityInterface*/ {
        $this->isGeneratedKey = (bool) $isGeneratedKey;
        $this->attribute = $attribute;
//        $this->id = spl_object_hash($this);
//        $this->idMD5 = md5($this->id);
    }

    /**
     * Vrací \TRUE  když klíč je generovaný.
     */
    public function isGenerated() : bool {
        return $this->isGeneratedKey;
    }

    
    /**
     * Vrací pole názvů polí atributu.
     * 
     * @return array
     */
    public function getKeyAttribute() {
        return $this->attribute;
    }

    /**
     * Vrací asociativní pole (názvů a hodnot) částí atributu.
     * 
     * @return Array asociativní pole názvů/hodnot částí atributu
     */
    public function getKeyHash() {
        return $this->keyHash;
    }    
    

    /**
     * Nastaví hodnoty klíče (keyHash). Parametrem je asociativní pole, které musí mít stejné indexy jako atribut.
     * 
     * Metodu nelze použít, pokud klíč je generovaný - při pokusu o nastevení hodnot generovaného klíče metoda vyhazuje výjimku.
     * V případě generovaného klíče mohou být hodnoty klíče nastaveny pouze na hodnoty načtené z databáze.
     * Hodnoty generovaného klíče nastavuje IdentityHydrator. IdentityHydrator používá reflexi a tak překoná toto omezení.
     * 
     * @param array $keyHash Asociativní pole. Jednoprvkové pro simple key, n-prvkové pro compound (composite) key. Indexy musí odpovídat polím atributu.
     * @return $this 
     * @throws \MismatchedIndexesToKeyAttributeFieldsException Pokud zadané pole má jiné indexy(jména čáístí klíče) než atributte.
     * @throws \AttemptToSetGeneratedKeyException Pokud dojde k pokusu o nastavení generovaného klíče.
     */      
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

    

   
    /**
     * Shodné klíče - mají stejné páry index/hodnota, nezáleží na pořadí.
     *      
     * @param IdentityInterface $identity
     * @return bool
     */
    public function isEqual( IdentityInterface $identity ) : bool {
        //$a == $b 	Equality 	TRUE if $a and $b have the same key/value pairs. - nezáleží na pořadí - testováno
        //$a === $b 	Identity 	TRUE if $a and $b have the same key/value pairs in the same order and of the same types.)
        return $this->keyHash == $identity->getKeyHash();
    }

    
    /**    
     * Shodný atribut klíče (jednoduchý nebo kompozitní) - klíče mají shodná pole (sloupce), nezáleží na pořadí.     
     * 
     * @param IdentityInterface $identity
     * @return bool
     */
    public function hasEqualAttribute( IdentityInterface $identity ) : bool {
        return $this->attribute == $identity->getKeyAttribute();
    }

    /**
     * Metoda rozhraní Serializable. Serializovanou hodnotu použít nař. jako index v kolekci. Je to také příprava pro případnu serializaci entity.
     * @return string
     */
    public function serialize() {
        return serialize(
                array(
                    'attribute' => $this->attribute,
                    'isGeneratedKey' => $this->isGeneratedKey,
                    'keyHash' => $this->keyHash
                ));
    }

    public function unserialize( $serialized ) {
        $data = unserialize($serialized);
        $this->attribute = $data['attribute'];
        $this->isGeneratedKey = $data['isGeneratedKey'];
        $this->keyHash = $data['keyHash'];
    }
}




   /**
     * Motivace:
     * Tabulka s kompozitním (správně kompoudním - compound) klíčem
     *
     * CREATE TABLE voting(QuestionID NUMERIC, MemberID NUMERIC);
     * nebo s primary key:
     * CREATE TABLE voting (QuestionID NUMERIC, MemberID NUMERIC, PRIMARY KEY (QuestionID, MemberID));
     *
     * můžeš volat:
     * SELECT * FROM voting WHERE QuestionID = 7 AND MemberID = 7
     * SELECT * FROM voting WHERE QuestionID = 7  (jen první část klíče - nutno použít postupně části klíče v pořadí zleva)
     * nelze volat:
     * SELECT * FROM voting WHERE MemberID = 7  (druhá část klíče v pořadí zleva)
     * a taky můžeš volat:
     * SELECT * FROM t WHERE (QuestionID, MemberID) IN ( (5,1), (7,2) );
     * pokud jsi nepoužil 'primary key', pak pro zrychlení:
     * CREATE INDEX voting_idx ON voting(QuestionID, MemberID); nebo CREATE UNIQUE INDEX voting_idx ON voting(QuestionID, MemberID);
     * a taky pro zrychlení i pro opačné pořadí zadaných klíčů CREATE UNIQUE INDEX voting_idx ON voting (MemberID, QuestionID);
     */
