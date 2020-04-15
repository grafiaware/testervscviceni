<?php
namespace Spoustec\Cosi;


/**
 * Description of Cosi
 *
 * @author vlse2610
 */
class CosiTest implements CosiInterface {
    
    public function __construct( ) {                        
    }
    
    public function start() {
     
//        $dbh = AppContext::getDb();
//        // podle agenda  v ticket - je-li to 'kampane' -  pro kampane precist vetu z kampane
//        $viewKampane = new ViewKampane2($dbh);
//        $radekZKampane = $viewKampane->get($id); // asi podle ticket.oznaceni
        
        
        echo "Spusten COSITEST... HA HA";
        
        include '../Tester/Test1zN.php';                
        
    
    }   
}
