<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of View
 *
 * @author pes2704
 */
class TestovaciKlikator_View {
    private $messages;
    private $links;
    private $definedTestDir;
    
    public function setMessages($messages) {
        $this->messages = $messages;
        return $this;
    }

    public function setLinks($links) {
        $this->links = $links;
        return $this;
    }
    
    public function setDefinedTestDir($definedTestDir) {
        $this->definedTestDir = $definedTestDir;
        return $this;
    }

        public function getResponse() {
        $response[] = '
            <!DOCTYPE html>
        <html>
            <head>
                <title>Klikator - Klik na odkaz testu</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
               ';

        $response[] = '
                <h2>Testovací klikátor</h2>
                <h3>Test ve složce '.$this->definedTestDir.'</h3>
                ';         
        if (isset($this->messages) AND $this->messages) {
            $response[] = '<div style="border: red solid 2px; padding: 5px;">';
            foreach ($this->messages as $message) {
                $response[] = '<p>'.$message.'</p>';
            }
            $response[] = '</div>';
        }
        foreach ($this->links as $legend => $a) {
            $response[] = '        
               <fieldset  style="float:left;">
               <legend>'.$legend.'</legend> 
               <div style="border: blueviolet solid 2px; padding: 5px;" >'; 
            foreach ($a as $txt => $href) {
                $response[] = '<p><a href="'.$href.'"><b>'.$txt.'</b> -> '.$href.'</a><p>';
            } 
            $response[] = '
                </div>
                </fieldset>'; 
        }

        $response[] = '
                </body>
        </html>';

        return implode(PHP_EOL, $response);        
    }
}
