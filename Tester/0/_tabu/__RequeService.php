<?php

namespace Tester\Service;

use Pes\Http\RequestInterface;
use Tester\Model\Handler\Session\SessionInterface;

/**
 * Description of RequeService
 *
 * @author vlse2610
 */
class RequeService implements RequeServiceInterface {
    
    const PARAM_GET_NAME = 'test';
    const PARAM_SESSION_IDENTIFIKACE = 'identifikace';
    const POST = 'POST';
    
    private $session;
    private $request;
    
    
    public function __construct( SessionInterface $session, RequestInterface $request) {
        $this->session = $session;
        $this->request = $request;
    }           
//     public function getRequeMethod() {
//       $value = $this->request->getMethod();
//       return $value;
//    }    
    
    // {  toto JE JEN PRIPAD ZE JE PRVNI SPUSTENI A MA  TATO METODA BYT JINDE???? POPR. TO vZIT Z REQUESTU rovnou
    public function getOznaceniZadostiZGET() {
       //$this->request->getParam('jmenoPromene');
       $paramTest = $this->request->getParam(self::PARAM_GET_NAME);
       return isset($paramTest) ? $paramTest : NULL  ;
    }           
    public function getOznaceniZadostiZSession() {
       $paramTest = $this->session->get( self::PARAM_SESSION_IDENTIFIKACE);     
       return isset($paramTest) ? $paramTest : NULL;
    } 
    
    /**
     * Je to prvni spusteni skriptu ?
     * @return boolean
    */
     public function isFirstRequestPodleSession() {                  
        return $this->session->get(self::PARAM_SESSION_IDENTIFIKACE) ? FALSE : TRUE;
     }
     /**
     * Je to prvni spusteni skriptu ?
     * @return boolean
    */
     public function jePozadavekNaSpusteniTestu() {                  
        return $this->session->get(self::PARAM_SESSION_IDENTIFIKACE) ? FALSE : TRUE;
     }
     
     /**
      * Platna je kazda  kdyz je oznaceni zadosti v session .
      * @return boolean
      */
      public function isPlatnaRundaPodleSession() {          
          return $this->session->get(self::PARAM_SESSION_IDENTIFIKACE ) ? TRUE : FALSE;   
                          
//        if  ( ( $this->request->getMethod() == 'POST')  AND              
//               $OK = TRUE;
//        }else {  $OK = FALSE;                 
//        }                          
//        return $OK ? TRUE:FALSE ;
      }
 
      
      public function isPostMethod() {       
         return ($this->request->getMethod() == self::POST  ) ? TRUE : FALSE ;
      }
      
     
    /**
     * U GETu zjistuje  pritomnost "quickformovych" promennych, maji v nazvu '_qf'.
     * Tzn. Je to GET z quickformoveho formulare?
     * 
     * @return boolean
     */
    public function isRequestQuickFormGet() {       
        if ($this->request->getMethod()== 'GET') {            
            $needle = '_qf';            
            $input = array_keys($this->request->getParams());
            $ret = array_keys(array_filter($input, function($var) use ($needle){return strpos($var, $needle) !== false;}  ));    
            if (isset($ret) AND count($ret)) {
                $requestQuickformGet = TRUE;
            }                
        }
        return $requestQuickformGet ? TRUE : FALSE ;
    }
    
    
    
}
