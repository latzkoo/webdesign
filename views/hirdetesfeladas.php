<div class="registration">
    <h1>Hirdetésfeladás</h1>
    <?php if (isset($_GET["success"])): ?>
        <article>
            <p>A hirdetésfeladás sikeres!</p>
            <p>Böngésszen a <a href="<?=Helper::buildURL("/fa4zpw/?page=hirdetesek")?>">feladott hirdetések</a> között, vagy adjon hozzá még egyet!</p>
            <a href="<?=Helper::buildURL("/fa4zpw/?page=hirdetesfeladas")?>">
                <button class="login tr-all">Új hirdetés feladása</button>
            </a>
        </article>
    <?php else: ?>
        <?php include("views/adform.php")?>
    <?php endif ?>
</div>