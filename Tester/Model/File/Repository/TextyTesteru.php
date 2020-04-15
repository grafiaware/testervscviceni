<?php
namespace Tester\Model\File\Repository;

use Tester\Model\File\Entity;

/**
 * Description of Texty
 *
 * @author vlse2610
 */
class TextyTesteru implements RepositoryTextyTesteruInterface {
  
      
    private $cesta;
    
    
    

    public function __construct( $cestaKTextumTesteru = '' ) {
        $this->cesta = $cestaKTextumTesteru;
    }
    
    
    
    
    /**
     * Vrací pole.
     * @param type $nazevSady
     * @return type
     */
    public function get(  $nazevSady ) {
        $arrayTextyTesteru = $this->getArrayTextyTesteru( $nazevSady );        
        return $arrayTextyTesteru ;
        
        //return $this->create( $arrayTextyTesteru );
    }
    
    
    
    
    /**
     * Nevim co to vraci.
     * @param string $nazevSady
     * @return  array 
     */
    public function find( $nazevSady ) {
        $arrayT = $this->getArrayTextyTesteru( $nazevSady );
        
        foreach ($arrayT as $id => $text) {
            $arrayT[$id] = $this->create( $text );   
        }
        return  isset($arrayT) ? $arrayT : NULL  ; 
    }
//------------------------------------------------------------------------------------------------
    
    
    /**
     * Vrací nesmysl - NULL.
     * @param  $textyTesteruArray
     * @return
     */
    private function create( $textyTesteruArrray ) {        
        //$textyTesteruO =  new TextyTesteru() ;
        //$textyTesteruO 
        
        //return ( $textyTesteruO );
        return ;
        
//            ->setNavigace( (new Navigace())->setNapis($textyTesteruArrray['navigace']['napis']))
//            ->setOtazka((new Otazka())
//                    ->setLegend( $textyTesteruArrray['otazka']['legend'])
//                    ->setZadani((new Zadani())
//                            ->setType( $textyTesteruArrray['otazka']['zadani']['type']) 
//                            ->setObsah((new Obsah())
//                                    ->setImgFileName( $textyTesteruArrray['otazka']['zadani']['obsah']['img_file_name'])
//                                    ->setLabel( $textyTesteruArrray['otazka']['zadani']['obsah']['label'])
//                                    ->setText ( $textyTesteruArrray['otazka']['zadani']['obsah']['text'])
//                            )
//                            ->setOdpoved( (new Odpoved())                                        
//                                    ->setType ($textyTesteruArrray['otazka']['zadani']['odpoved']['type'] )
//                                    ->setData( ( new Data())
//                                            ->setLabel($textyTesteruArrray['otazka']['zadani']['odpoved']['data']['label'] )
//                                            ->setContent($textyTesteruArrray['otazka']['zadani']['odpoved']['data']['content'])  //...nyni1-4
//                                            ->setOk($textyTesteruArrray['otazka']['zadani']['odpoved']['data']['ok'])                                                
//                                    )                                        
//                            )                               
//                    )        
//            );
                
    }
    
    
    
    /**
     * Precte soubor json a vrati virozmerne pole textu.
     * @param string $nazevSady
     * @return array
     * @throws \UnexpectedValueException
     * @throws \LogicException
     */
    private function getArrayTextyTesteru( $nazevSady ) {
        $fuileTexty   = $this->cesta . $nazevSady . ".json";                  
        $readedJson = file_get_contents( $fuileTexty );
        if ($readedJson === FALSE) {
            throw new \UnexpectedValueException("Požadovaný soubor '$fuileTexty' bohužel neexistuje!");
        }          
        $arrayTexty = json_decode($readedJson, TRUE);
        if  ( !isset($arrayTexty) OR !is_array($arrayTexty) ) {
            throw new \LogicException("Soubor $fuileTexty neobsahuje správná data. Soubory musí obsahovat platná data ve formátu json.");
        }
        return $arrayTexty;
    }
    
    
}
