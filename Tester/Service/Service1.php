<?php
namespace Tester\Service;

use Tester\Model\Handler\SessionInterface;
use Pes\Http\RequestInterface;


/**
 * Description of  Service
 */
class Service1 implements ServiceInterface1 {
                 
    const SESSION_TEST_TRVA    = 'testTrva';
    const SESSION_ID_SPUSTENY_TEST    = 'identifikatorSpustenehoTestu';
    
    private $request;
    private $sessionHandler;

    public function __construct(  RequestInterface $request, SessionInterface $session ) {     
        $this->request = $request;
        $this->sessionHandler = $session; 
    }           
    
    
    /**
     * {@inheritdoc}
     *
     */
    public function trvaTest(): bool {          
        $trva = $this->sessionHandler->get(self::SESSION_TEST_TRVA) ? TRUE : FALSE;
        return  $trva; 
    }  
   
    /**
     * {@inheritdoc}
     *    
     */
    public function  nastavTestTrva(): ServiceInterface {
         $this->sessionHandler->set(self::SESSION_TEST_TRVA, TRUE);
    // moznosti navrat.hodnoty :    
    //return ;  
        return $this; 
    //retuen 'succes'= true/false po smysluplne operaci;
    }    
    
    /**
     * {@inheritdoc}
     *    
     */
    public function nastavTestNetrva() : ServiceInterface {        
        $this->sessionHandler->unsetName(self::SESSION_TEST_TRVA);
    return $this;         
    }    
       
    
    
    public function dejIdentifikatorSpustenehoTestuZeSession() :string {
        $identifikatorTestu = $this->sessionHandler->get(self::SESSION_ID_SPUSTENY_TEST);
        return  isset($identifikatorTestu) ? $identifikatorTestu : NULL  ;
    }
    
    
    
    /**
     * 
     * @return boolean
     */
    public function jeMetodaRequestuGET() : bool  {               
        $m = $this->request->getMethod();
        return ($m == 'GET')? TRUE : FALSE;      
    } 
    
    /**
     * 
     * @return boolean
     */
    public function jeMetodaRequestuPOST() : bool  {                  
        $m = $this->request->getMethod();
        return ($m == 'POST')? TRUE : FALSE;              
    } 
    
    
    
    /**
     * 
     * @return boolean
     */
    public function jeMetodaRequestuGETzQuickformu() : bool  {
    if ($this->jeMetodaRequestuGET()) {
        $getParams = $this->request->getQueryParams();
        $needle = '_qf';
        $input = array_keys($getParams);            
        $ret = array_keys(array_filter($input, function($var) use ($needle){return strpos($var, $needle) !== false;}  ));
        if (isset($ret) AND count($ret)) {
           return TRUE;
        }    
        else {return FALSE;    }
    }
    else { return FALSE;}
    }    
    
    
    /**
     * 
     * @return boolean
     */
    public function jeMetodaRequestuPOSTzQuickformu() : bool  {
    if ($this->jeMetodaRequestuPOST()) {
        $getParams = $this->request->getParsedBody();
        $needle = '_qf';
        $input = array_keys($getParams);            
        $ret = array_keys(array_filter($input, function($var) use ($needle){return strpos($var, $needle) !== false;}  ));
        if (isset($ret) AND count($ret)) {
           return TRUE;
        }    
        else {return FALSE; }   
    }
    else { return FALSE;}
    }    

         
    /**
     * 
     * @return boolean
     */
    public function jeInicializacniGet() : bool {                 
        $m = $this->request->getMethod();
        if ($m == 'GET'){
            $existidTest = $this->request->getParam(self::PARAM_GET_IDENT_KONFIGURACE_TESTU) ;
            $existidTicket = $this->request->getParam(self::PARAM_GET_IDENT_TICKETU) ;
            if ($existidTest and $existidTicket) {return TRUE;}            
        }          
        return FALSE;
    } 
         
    
    /**
     * Vrací označení ticketu z GET promenne nebo NULL.
     */
    public function dejIdentifikatorTicketuZGET() : string {    
         $identifikatorTicketu = $this->request->getParam(self::PARAM_GET_IDENT_TICKETU); 
         return isset($identifikatorTicketu) ? $identifikatorTicketu : NULL  ;
    }
    
    
    /**
     * Vrací označení konfigurace testu z GET promenne nebo NULL.
     */
    public function dejIdentifikatorKonfiguraceTestuZGET()  : string {    
         $identifikatorTestu = $this->request->getParam(self::PARAM_GET_IDENT_KONFIGURACE_TESTU); 
         return isset($identifikatorTestu) ? $identifikatorTestu : NULL  ;
    }
    
   
    
    function functionName($param) {
        
    }
    
    
    
    
    /**
     * Vrací označení konfigurace testu. (napr. z GET promenne, nebo session ). 
     * Vrati NULL, pokud nenalezne ve vyse uvedenych mistech.
     * @return varchar
     */    
    public function dejIdentifikatorKonfiguraceTestu() : string  {
       //$this->request->getParam('jmenoPromene');
        $trvaTest  = $this->trvaTest();   //SESSION_TEST_TRVA      
    
        if ($trvaTest) { // SESSION_TEST_TRVA existuje
            // trva test                             
            $identifikatorTestu = $this->sessionHandler->get(self::SESSION_TEST_TRVA);
        }  
        else { 
            //identifikator konfigurace je mozna nekde v tabulce - nutno by najit
            
            //netrva test        
            $identifikatorTestu = $this->request->getParam(self::PARAM_GET_IDENT_KONFIGURACE_TESTU);                   
        }       
             
        return isset($identifikatorTestu) ? $identifikatorTestu : NULL  ;
    }    

}

//$requestMethod = $_SERVER['REQUEST_METHOD'];
//
// $query_str = parse_url($redirectUrl, PHP_URL_QUERY);  // s touto konstantou vrací jen query                
//      $identifikace_parametr_test_zGETu = filter_input(INPUT_GET,'test');
