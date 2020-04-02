<section class="login">
    <h1>Belépés</h1>
    <div class="formblock">
        <form action="/fa4zpw/?page=belepes" method="post">
            <input type="hidden" name="redirect_to"
                   value="<?= isset($_GET["redirect_to"]) && !empty($_GET["redirect_to"]) ? $_GET["redirect_to"] :
                       (isset($_SERVER["HTTP_REFERER"]) ? \app\Helper::getPageURLFromReferer($_SERVER["HTTP_REFERER"]) : "/fa4zpw/") ?>"/>
            <fieldset>
                <legend>Belépési adatok</legend>
                <div class="row">
                    <div class="col1">
                        <label for="email">E-mail cím<span>*</span></label>
                        <input type="email" name="email" id="email" maxlength="100" required="required"
                            <?=isset($_POST["email"]) && !empty($_POST["email"]) ? ' value="' . $_POST["email"] . '"' : ' autofocus' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="col1">
                        <label for="passwd">Jelszó<span>*</span></label>
                        <input type="password" name="passwd" id="passwd" required="required"
                            <?=isset($_POST["passwd"]) && !empty($_POST["passwd"]) ? ' value="' . $_POST["passwd"] . '"' :
                            ((isset($_POST["email"]) && !empty($_POST["email"])) &&
                            (!isset($_POST["passwd"]) || (isset($_POST["passwd"]) && empty($_POST["passwd"]))) ? ' autofocus' : '') ?> />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col1">
                    <button class="tr-all">Belépés</button>
                </div>
            </div>
            <?php include_once("error.php") ?>
        </form>
    </div>
</section>