<?php
namespace Spoustec\Validator;

use Spoustec\Service\ServiceRequestNaSpusteniInterface;

/**
 * Description of Validator
 *
 * @author vlse2610
 */
class ValidatorPozadavekSpusteni implements ValidatorInterface {      
    private $serviceRequestNaSpusteni ;
    
    
    public function __construct( ServiceInterface  $serviceRequestNaSpusteni ) {
        $this->serviceRequestNaSpusteni = $serviceRequestNaSpusteni ;
    }
    
    
    
    public function isValid() {
        $OK = TRUE;
        $zprava = "";
        
        if ($OK) {
            $metoda = $this->serviceRequestNaSpusteni->dejMetoduRequestu();
            if ( $metoda != "GET" ) { $OK = FALSE;  $zprava .= "Metoda není GET. " ; }
        }
        if ($OK) {
            $oznaceni =  $this->serviceRequestNaSpusteni->dejParametrSkriptuIdentifikatorTicketu();
            if ( !isset($oznaceni) )  {  $OK = FALSE; $zprava .= "Parametr skriptu na spuštění (identifikátor ticketu)  nezadán. " ; }
        }     
        
        if (!$OK) {
            throw new \UnexpectedValueException( "Parametr skriptu není validní. " . $zprava ) ; //vyhazovat ve validatoru
        }
        
//        assert( FALSE , "ValidatorPozadavek je prazdny") ;
        //return isset($oznaceni) ? TRUE : FALSE;
        return $OK;
        
    }
    
    
    
    
//    private function existParametrSkriptuPozadavekVGet () {
//        return $this->dotazovac->dejOznaceniZadostiZGET();
//        
//    }
    
    
//    private function existParametrSkriptuProAgenduProjektor ( DotazovacServiceInterface  $dotazovacService /*SessionInterface $mojeSession */) {
//        
//        $p = $dotazovacService->dejOznaceniZadostiZGET();
//     
//        return  $p  ?? NULL ;        //je-li NUll, tak vrat  NULL null coalesce operator
//    }
    
}
