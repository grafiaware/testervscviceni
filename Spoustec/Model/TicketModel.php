<?php
namespace Spoustec\Model;

use Pes\Database\Handler\HandlerInterface;

/**
 * Description of 
 *
 * @author vlse2610
 */
class TicketModel implements DbTableInterface {
    
    /**
     * @var HandlerInterface 
     */
    private $dbh;
    
    public function __construct( HandlerInterface  $dbh) {
        $this->dbh = $dbh;
    }
    
    public function find($param) {
        ;
    }
  
  
    /**
     * Vraci vzdy 1 radek tabulky (vetu) nebo zadny tj. NULL.
     * @param type $id
     */
    public function get($id) {    

        $prectena_veta_z_ticket = array("id_ticket" => "1", "cosi" => "test") ;
        return    $prectena_veta_z_ticket;
        //-------------------------------
        
        $query = "SELECT id_ticket,  cosi, agenda, cas_platnosti
                    FROM ticket                 
                    WHERE 
                    id_ticket = :id";                
        $statSelect = $this->dbh->prepare($query);
        $statSelect->bindParam(':id', $id);
        $succ = $statSelect->execute();

        $pp = $statSelect->rowCount();    
        $prectena_veta_z_ticket =  $statSelect->fetch(\PDO::FETCH_ASSOC);

        return    $prectena_veta_z_ticket; 
    }
    
    
    public function save($data) {
        ;
    }
    
}
