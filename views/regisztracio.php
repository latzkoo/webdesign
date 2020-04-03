<section class="registration">
    <h1>Regisztráció</h1>
    <?php if(isset($_GET["success"])): ?>
    <article>
        <p>A regisztráció sikeres!</p>
        <p>Bejelentkezést követően lehetősége nyílik apróhirdetést feltölteni.</p>
        <a href="/fa4zpw/?page=belepes"><button class="login tr-all">Belépés</button></a>
    </article>
    <?php else: ?>
    <div class="formblock">
        <form action="/fa4zpw/?page=regisztracio" method="post">
            <fieldset>
                <legend>Regisztrációs adatok</legend>
                <div class="row">
                    <div class="col2">
                        <label for="lastname">Vezetéknév<span class="required">*</span></label>
                        <input type="text" name="lastname" id="lastname" maxlength="50" required="required"
                        <?=isset($_POST["lastname"]) && !empty($_POST["lastname"]) ? ' value="' . $_POST["lastname"] . '"' : ' autofocus' ?> />
                    </div>
                    <div class="col2">
                        <label for="firstname">Keresztnév<span class="required">*</span></label>
                        <input type="text" name="firstname" id="firstname" maxlength="50" required="required"
                        <?=isset($_POST["firstname"]) && !empty($_POST["firstname"]) ? ' value="' . $_POST["firstname"] . '"' : ' autofocus' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="col2">
                        <label for="email">E-mail cím<span class="required">*</span></label>
                        <input type="email" name="email" id="email" maxlength="100" required="required"
                        <?=isset($_POST["email"]) && !empty($_POST["email"]) ? ' value="' . $_POST["email"] . '"' : ' autofocus' ?> />
                    </div>
                    <div class="col2">
                        <label for="birthday">Születési év</label>
                        <input type="date" name="birthday" id="birthday"
                        <?=isset($_POST["birthday"]) && !empty($_POST["birthday"]) ? ' value="' . $_POST["birthday"] . '"' : '' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="col2">
                        <label for="passwd">Jelszó<span class="required">*</span></label>
                        <input type="password" name="passwd" id="passwd" minlength="6"
                               maxlength="20" autocomplete="new-password" required="required"
                            <?=isset($_POST["passwd"]) && !empty($_POST["passwd"]) ? ' value="' . $_POST["passwd"] . '"' : ' autofocus' ?> />
                    </div>
                    <div class="col2">
                        <label for="repasswd">Jelszó megerősítése<span class="required">*</span></label>
                        <input type="password" name="repasswd" id="repasswd" minlength="6"
                               maxlength="20" autocomplete="new-password" required="required"
                        <?=isset($_POST["repasswd"]) && !empty($_POST["repasswd"]) ? ' value="' . $_POST["repasswd"] . '"' : ' autofocus' ?> />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col1">
                    <button class="tr-all">Regisztráció</button>
                </div>
            </div>
            <?php include_once("error.php") ?>
        </form>
    </div>
    <?php endif ?>
</section>