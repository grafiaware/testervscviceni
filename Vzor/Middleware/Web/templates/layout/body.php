    <div class="ui container">
        <div class="column">
            <header>
                <?php include "body/hlavicka.php"; ?>
            </header>
            <main class="page-content">
                <?php include "body/telo.php"; ?>
                <?= $poznamky ?? ''?>
            </main>
            <footer>
                <?php include "body/paticka.php"; ?>
            </footer>
        </div>

    </div>