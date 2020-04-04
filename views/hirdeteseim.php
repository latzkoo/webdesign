<?php if(isset($notfound)): ?>
    <?php include("views/404.php")?>
<?php elseif (isset($_GET["success"])): ?>
    <h1>Hirdetés szerkesztése</h1>
    <article>
        <p>A hirdetés módosítása sikeres!</p>
        <p>Tekintse meg a <a href="<?=Helper::buildURL("/fa4zpw/?page=hirdeteseim")?>">hirdetései listáját</a>, vagy adjon hozzá egy újat!</p>
        <a href="<?=Helper::buildURL("/fa4zpw/?page=hirdetesfeladas")?>">
            <button class="login tr-all">Új hirdetés feladása</button>
        </a>
    </article>
<?php elseif(isset($ad) && !empty($ad)): ?>
    <div class="adblock">
        <h1>Hirdetés szerkesztése</h1>
        <?php include("views/adform.php")?>
    </div>
<?php else: ?>
    <h1>Hirdetéseim <span class="items">(<?=isset($ads) ? count($ads) : 0?>)</span></h1>
    <?php include("views/ads.php")?>
<?php endif ?>
