<!DOCTYPE html>
    <html>
        <head>
            <title>Start testu</title>
            <meta charset="UTF-8">
            <meta http-equiv="Content-Language" content="cs"> 
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="public/css/styles.css">
            <link rel="stylesheet" href="public/css/form.css">
        </head>
        <body>
            <img src = "../Tester/obrazky/Grafia100.jpg" alt="logoGrafia" title="logo Grafia"  />            

            <h2>Přihlašte se do testu.</h2>

            <form method="POST" action="start.php">
              <fieldset>
                <?= isset($message) ? '<p class="message">'.$message.'</p>' : '' ?>
                <div>
                <label><b>Číslo testu</b></label>
                <input type="number" step="1" min="1" placeholder="Zadejte číslo" name="idtest" required <?= isset($idtest) ? 'value="'.$idtest.'"' : '' ?>>
                <label><b>Příjmení</b></label>
                <input type="text" placeholder="Zadejte příjmení" name="prijmeni" required <?= isset($prijmeni) ? 'value="'.$prijmeni.'"' : '' ?>>
                <label><b>Jméno</b></label>
                <input type="text" placeholder="Zadejte křestní jméno" name="jmeno" required <?= isset($jmeno) ? 'value="'.$jmeno.'"' : '' ?>>
                <input type="hidden" name="form" value="prihlaseni">

                <button type="submit" name="start" value=1>Přihlásit</button>
                </div>
              </fieldset>
            </form>
        </body>
    </html>

}
