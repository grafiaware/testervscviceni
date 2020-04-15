<?php
/**
 * Kontejner na globalni promenne
 * @author Petr Svoboda
 */
class Accessor_AppContext
{
    const ROOT_DIRECTORY_PATH = '/Tester/';
    const TEST_CONTEXT_BASE_CLASS_NAME = 'TestContext';
    
    public static function getIdentificatorValidator() {
        return new Tester_Accessor_Validator_IsNaturalNumberValidator();
    }
    
    public static function getLogReceiverMailAddress() {
        return 'svoboda@grafia.cz';
    }
    
    public static function getLogDirectory() {
        return 'log/';
    }
    
    /**
     * Vrací objekt s kontextem (kontejner) testu ma základě parametru. Parametrem je url adresa na kterou bylo přesměrováno původní volání.
     * Používá konstanty této třídy, které musí odpovídat použitému uspořádání složek a názvu tříd s kontextem.
     * 
     * Příklad:
     * pro url "/Tester/Zakazky/Firmicka/run-bWRlMjAxNjAzMTI4MA==" musí být konstanta const ROOT_DIRECTORY_PATH = '/Tester/'
     * a pokud je konstanta const TEST_CONTEXT_BASE_CLASS_NAME = 'TestContext', pak se tato metoda pokusí vytvořit 
     * objekt Zakazky_Firmicka_TestContext()
     * 
     * @param type $redirectUrl
     * @return Accessor_TestContextInterface Objekt kontextu (kontejneru) testu
     * @throws UnexpectedValueException
     */
    public static function getTestContextObject($redirectUrl) {
        // "/Tester/Zakazky/Firmicka/run-bWRlMjAxNjAzMTI4MA=="
        
        $relative = str_replace(self::ROOT_DIRECTORY_PATH, '', $redirectUrl);
        $name = str_replace('/', '_', substr($relative, 0, strrpos($relative, '/'))).'_'.self::TEST_CONTEXT_BASE_CLASS_NAME;
        if (!class_exists($name)) {
            throw new UnexpectedValueException('Neexistuje třída '.$name);
        }
        $contextClass =  new $name;
        if ($contextClass instanceof Accessor_TestContextInterface) {
            return $contextClass;
        } else {
            throw new UnexpectedValueException('Třída '.$name.' neimplementuje interface Accessor_TestContextInterface.');
        }
            
    }
}