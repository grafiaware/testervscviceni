<?php
/**
 * POZOR - tento kontejner nemá statické metody a instancuje se - viz Accessor
 * 
 * Kontejner na globalni promenne
 * @author Petr Svoboda
 */
class Zakazky_Zkusebni_TestContext implements Accessor_TestContextInterface {
    ############ parametry volání #######################
    
    /**
     * Odkazy, ze kterých se volá test mají strukturu: [url]/[prefix][parametr]
     * Celý odkaz nesmí obsahovat whitespaces (mezery a další).
     * 
     * [url] je url adresa (např http://podadresar.mehowebu.cz:888)
     * 
     * [prefix] je řetězec ležící bezprostředně za posledním lomítkem odkazu. Tento řetězec je rozpoznáván pravidlem v souboru .htaccess
     * a musí tedy být s tímto pravidlem v souladu. Pro potřeby aplikace musí být v této třídě metoda getAcceptedScriptnamePrefix(), 
     * která musí vracet řetězec použitý jako [prefix].
     * 
     * [parametr] je vše co leží za řetězcem [prefix]. Také tento řetězec je rozpoznáván v .htaccess a při přesměrování je předán 
     * jako paramer "runparam". Parametr může být zakódován. Proto musí tato třífa implementovat metodu getRequestParameterKoder(), 
     * která vrací objekt typu Accessor_Coder_CoderInterface. Takový objekt má metody encode() a decode() a tyto metody jsou používány 
     * při vytváření odkazů (encode) a při jejich ověření ři zpracování (decode) (např v aplikaci Accesor).
     * 
     * Řetězce [prefix] a [parametr] mohou obsahovat pouze nerezervované znamky dle RFC 3986 (celý odkaz je validní url)
     * rezervované znaky ! * ' ( ) ; : @ & = + $ , / ? # [ ]
     * nerezervované znaky A B C D E F G H I J K L M N O P Q R S T U V W X Y Z a b c d e f g h i j k l m n o p q r s t u v w x y z 0 1 2 3 4 5 6 7 8 9 - _ . ~
     * 
     * 
     * Příklad:
     * V souboru .htaccess jsou řádky:
     * RewriteCond %{REQUEST_FILENAME} ^run-
     * RewriteRule ^run-(.*) "Relocator.php?runparam=$1" [QSA,L]
     * 
     * Pravidla v .htaccess tedy rozpoznávají řetězec "run-". Metoda getAcceptedScriptnamePrefix() musí vracet řetězec "run-".
     * Odkazy, které směřují do tohoto adresáře pro spuštění testu musí za posledním lomítkem mířetezec začínající "run-".
     * 
     * Například: http://podadresar.mehowebu.cz:888/run-
     */
    
    
    /**
     * Začátek jména volaného skripru, který musí být uveden v odkazu, ze kterého se test spouští
     * např. pro AcceptedScriptnamePrefix='run-' musí odkaz vypadat http://nekdo.nekde/run-apaknejakeparametry
     * @return string
     */
    public function getAcceptedScriptnamePrefix() {
        return 'run-';
    }
    
    /**
     * Kodér pro kódování parametru. Kodér musí být objekt typu Accessor_Coder_CoderInterface.
     * @return Accessor_Coder_CoderInterface
     */
    public function getRequestParameterKoder() {
        return new Accessor_Coder_Base64Coder;
    }
    
    /**
     * Query builder pro sestavení a rozklad výsledného parametru 
     * @return Accessor_QueryBuilder_QueryBuilderInterface
     */
    public function getQueryBuilder() {
        return new Accessor_QueryBuilder_HttpQueryBuilder();
    }
    
    /**
     * Název skriptu, na který bude provedeno přesměrování, pokud kontroly v aplikaci Accessor proběhnou v pořádku.
     * Název skriptu je nutné zadat relativně k adresáři, ve kterém je TENTO skript. Do tohoto adresáře směřuje původní volání
     * a .htaccess provádí jen podstrčení, nikoli přesměrování. To zbnamená, že původní adresa skriptu zůstane zachvána.
     * @return string
     */
    public function getTargetScriptName() {  
        return '../../Tester/Test1zN.php';
        //return 'http://projektor/Tester/Tester/Test1zN.php';
    }
}