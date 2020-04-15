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

            <?php if (isset($dbName)) : ?>
            <p>&#1421; 
                <span class="vsCervenaSrdce">&hearts;</span> 
                Pracujete s databází  <?= $dbName ?>  na stroji <?= $dbHost ?>
                <span class="vsCervenaSrdce">&hearts;</span>
            </p>
            <?php endif ?>
            
            <h2>Spusťte test.</h2>     
            <form class="" method="POST" action="start.php">
              <fieldset>
              <div>
                <p>Přeji si spustit test: <?= $test_nazev ?></p><p> pro osobu: <?= $prijmeni ?> <?= $jmeno ?>.</p>
                <input class="" type="hidden" name="idvzbosobakampan" value='.$id_vzb_osoba_kampan.'>
                <input class="" type="hidden" name="form" value="start">
                </div>
                <div>
                <button class="" type="submit" name="start" value=1>Start!</button>
                </div>
              </fieldset>
            </form>

        </body>
    </html>
