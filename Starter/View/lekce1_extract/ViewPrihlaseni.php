<?php

/**
 * Description of View
 *
 * @author pes2704
 */
class Starter_View_ViewPrihlaseni {

    public function getResponse($context) {
        extract($context);
        $response[] = '
            <!DOCTYPE html>
        <html>
            <head>
                <title>Start testu</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="public/css/styles.css">
                <link rel="stylesheet" href="public/css/form.css">
            </head>
            <body>
            <img src = "../Tester/obrazky/Grafia100.jpg" alt="logoGrafia" title="logo Grafia"  />            
               ';

        $response[] = '<h2>Přihlašte se do testu.</h2>';         

        $response[] = '        
            <form method="POST" action="start.php">
              <fieldset>';
        if (isset($message)) {
            $response[] = '<p class="message">'.$message.'</p>';   
        }
        $response[] = '
                <div>
                <label><b>Číslo testu</b></label>
                <input type="number" step="1" min="1" placeholder="Zadejte číslo" name="idtest" required '.$this->valueAttribute($idtest ?? NULL).'>
                <label><b>Příjmení</b></label>
                <input type="text" placeholder="Zadejte příjmení" name="prijmeni" required '.$this->valueAttribute($prijmeni ?? NULL).'>
                <label><b>Jméno</b></label>
                <input type="text" placeholder="Zadejte křestní jméno" name="jmeno" required '.$this->valueAttribute($jmeno ?? NULL).'>
                <input type="hidden" name="form" value="prihlaseni">

                <button type="submit" name="start" value=1>Přihlásit</button>
                </div>
              </fieldset>
            </form>'; 

        $response[] = '
                </body>
        </html>';

        return implode(PHP_EOL, $response);        
    }
    
    private function valueAttribute($value=NULL) {
        return isset($value) ? 'value='.$value : '';
    }
}
