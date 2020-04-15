<?php


/**
 * Metoda není nyní pouzita. Je zde zachycen postup zjistovani 'validity' provadeneho testu.
 *
 * @author vlse2610
 */
class _Tester_Tabbed_Handler_Submit extends _Tester_Tabbed_Handler_SubmitCommon 
                                implements HTML_QuickForm2_Controller_Action   {        
    /**
     * Vraci bud response nebo NULL, kdyz  test je ukoncen a neukladalo se.
     * @param HTML_QuickForm2_Controller_Page $page    
     * @param type $name
     * @return ResponseInterface/NULL
     */
    public function perform (    HTML_QuickForm2_Controller_Page $page, $name )    {
        $valid = $page->storeValues();  // stranka validni y/n

        // 1 - All pages are valid, process
        if ($page->getController()->isValid()) {        // controler je ten "nas tabbed"  -ano, kontroler vlastnici tento page controler
            $page->handle('process');      // Handler\Process (metoda perform)      // volam process,  process je objekt typu .HTML_QuickForm2_Controller_Action                                                        
            // tady si myslim, ze vraci: response (bude GET dekujeme) = ukladal, byla to posledni uloha,  /x nebo x/: NULL = neukladal,tj. pri jiz ukoncenem testu jiz neuklada       
            return ['handler'=>'process'];
        // 2 - Current page is valid,  display it  jinou
        } elseif ($valid) {      // zobrazi dalsi v poradi ktera je invalid, zobrazi v dalsi runde
            // Some other page is invalid, redirect to it  //nejaka neodpovedena uloha
            $idUloha = $page->getController()->getFirstInvalidPage()->handle('jump');  // vraci response
            return ['handler'=>'jump', 'idUloha'=> $idUloha];
        // currentni otazka(uloha) nema splnena pravidla (napr. u povinne odp. neni odpovezeno), zobrazi v dalsi runde tuto s cervenym rameckem    
        } else {      
            $htmlRed = $page->handle('display');
            return ['handler'=>'display', 'htmlRed'=> $htmlRed];
        }
    }
}
