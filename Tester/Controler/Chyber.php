<?php
namespace Tester\Controler;

use Pes\Http\Response;
use Pes\Http\Headers;
use Pes\Http\Body;


/**
 * Chyber neboli ChybovyControler
 *
 * @author vlse2610
 */
class Chyber extends ControllerAbstract {
    
    /**
     * 
     * @param string $output
     * @return Response
     */
    public function chyba( string $output ) {
        
        $response = new Response( 200 ); 
        $response->getBody()->write($output); 
        return $response;
       
    }
    
    
}
