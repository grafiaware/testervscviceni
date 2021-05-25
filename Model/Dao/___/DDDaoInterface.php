<?php
//namespace Model\Dao;

use Model\RowObject\RowObjectInterface;

/**
 *
 * @author vlse2610
 */
interface DDDaoInterface {

    /**
     * Metoda get.
     * 
     * Vrací objekt RowObjectInterface s vlastnostmi nastavenými na hodnoty přečtené z databázové tabulky podle zadaného identifikátoru $uid. 
     * Pokud neexistuje záznam se zadaným identifikátorem, vrací null. Vracený objekt má nastavenu vlastnost persisted = TRUE.
     * 
     * @param mixed $uid Identifikátor
     * @return RowObjectInterface|null
     */
    public function get( $uid ): ?RowObjectInterface;
    
    
    /**
     * Metoda find.
     * 
     * Vrací pole objektů typu RowObjectInterface z úložiště (databáze). Vracené objekty mají nastavenu vlastnost persisted na TRUE.
     * 
     * @param string $sqlTemplateWhere SQL příkaz s placeholdery
     * @param array $poleNahrad Asociativní pole náhrad placeholderů     
     */
    public function find( $sqlTemplateWhere, array $poleNahrad ) :array ;
    
    
    /**
     * Metoda save.
     * 
     * Uloží vlastnosti objektu typu RowObjectInterface do databáze. Automaticky volí insert nebo update podle toho, zda objekt 
     * je již persistován. Objektu RowObjectInterface, který ještě nebyl persistován a neměl nastavenu hodnotu identifikátoru, 
     * nastaví hodnotu identikátoru odpovídající primárnímu klíči v databázi a vlastnost persisted na TRUE (insert).
     * 
     * (Pozn.: Je-li definován v tabulce autoincrementální id, nastaví do $rowObjectu nově vzniklé autoincrement id (v metodě $this->execInsert).)     
     * Není-li id  definováno jako autoincrementální, volá se metoda $this->execInsertWithUid.)     
     * 
     * Pozn.: 'vraci se zpět' referencí ten samý objekt $rowObject. Je v parametru.
     * 
     * @param RowObjectInterface $rowObject
     * @return void
     */
    public function save( RowObjectInterface $rowObject ): void ;
    
    
    /**
     * Metoda delete.
     * 
     * Smaže řádek v databázi s vlastnostmi objektu zadaného jako parametr. 
     * Zadanému objektu nastaví vlastnost persisted na FALSE a smaže vlastnosti obsahující identifikátor. 
     * Samotný objekt nemaže.
     * 
     * @param RowObjectInterface $rowObject
     * @return void
     */
    public function delete( RowObjectInterface $rowObject): void ;
     
}

//    @return void == metoda nevraci 'nic' , k 'vraceni' vubec nedochází