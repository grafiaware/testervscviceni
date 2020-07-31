<?php
namespace Model\Entity\Identity;

use Model\Entity\Identity\IdentityInterface;

/**
 *
 * @author pes2704
 */
interface IdentityInterface  {
    
    /**
     * Vrací \TRUE  když klíč je generovaný.
     */
    public function isGenerated() : bool ;
    
    /**
     * Vrací pole názvů částí atributu. 
     * 
     * @return array     
     */
    public function getKeyAttribute();
    
    /**
     * Vrací asociativní pole (názvů a hodnot) částí atributu. 
     * 
     * @return Array asociativní pole názvů/hodnot částí atributu
     */  
    public function getKeyHash();
    
    
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
    public function setKeyHash(array $keyHash);
    
   
    /**
     * Shodné klíče - mají stejné páry index/hodnota, nezáleží na pořadí.
     *      
     * @param IdentityInterface $identity
     * @return bool
     */
    public function isEqual( IdentityInterface $identity ) : bool   ;

   
    /**
     * Shodný atribut klíče (jednoduchý nebo kompozitní) - klíče mají shodná pole (sloupce), nezáleží na pořadí.     
     * 
     * @param IdentityInterface $identity
     * @return bool
     */
    public function hasEqualAttribute( IdentityInterface $identity) :bool ;    
}



