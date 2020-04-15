<?php
namespace Spoustec\Service;

use Spoustec\Model\DbTableInterface;
use Spoustec\Model\PozadavekSpusteni;

use Spoustec\Cosi\CosiTest;
use Spoustec\Cosi\CosiInterface;
use Spoustec\Service\CosiFactoryInterface;

use Spoustec\Service\ServiceRequestNaSpusteniInterface;
use Pes\Database\Handler\HandlerInterface;

/**
 * Description of Pripravar
 *
 * @author vlse2610
 */
class CosiFactory implements CosiFactoryInterface {
    
    //private $validatorPozadavku;
    private $obsluhaRequest;
    private $obsluhaSession;
   // private $ticket;
    //private $validatorTicket;
    //private $dbh;
             
             
//    private function  __construct(    /*cosi*/    ) {       
//       // $this->obsluhaRequest = $serviceRequestNaSpusteni;
//       // $this->obsluhaSession = $obsluhaSession;                     
//    }
//    
    
    
    public  function create( $target  ): CosiInterface {                                           
//      $en = $this->pozadavekNA;
//        switch ($en($cosiValue)) {
//            case CosiEnum::TEST:
//                assert(FALSE, 'Spoutění '.$cosiValue.' není v metodě '.__METHOD__.' dosud implementováno, polepši se!!');
//                break;
//            default:
//                throw new \UnexpectedValueException('Chcete spustit cosi {cosi}. Takové cosi neznáme!!', array('cosi'=>$cosiValue));
//        }
        
        //vyrobi spravny  druh objektu cosi, zde na tvrdo CosiTest                   
        switch ($target) {
            case 'test':
                 $cosi = new CosiTest (  ) ;  // asi z ticket.cosi      

                break;

            default:
                break;
        }                       
      
        return $cosi;
    }
    
}
