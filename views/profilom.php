<section class="registration">
    <h1>Profilom</h1>
    <div class="formblock">
        <form action="/fa4zpw/?page=profilom" method="post">
            <?php include("views/sessid.php")?>
            <fieldset>
                <legend>Adataim módosítása</legend>
                <div class="row">
                    <div class="col2">
                        <label for="lastname">Vezetéknév</label>
                        <input type="text" name="lastname" id="lastname" maxlength="50" required="required"
                            <?= isset($_SESSION["user"]->lastname) && !empty($_SESSION["user"]->lastname) ? ' value="' . $_SESSION["user"]->lastname . '"' : ' autofocus' ?> />
                    </div>
                    <div class="col2">
                        <label for="firstname">Keresztnév</label>
                        <input type="text" name="firstname" id="firstname" maxlength="50" required="required"
                            <?= isset($_SESSION["user"]->firstname) && !empty($_SESSION["user"]->firstname) ? ' value="' . $_SESSION["user"]->firstname . '"' : ' autofocus' ?> />
                    </div>
                </div>
                <div class="row">
                    <div class="col2">
                        <label for="email">E-mail cím</label>
                        <input type="email" name="email" id="email" maxlength="100" required="required"
                            <?= isset($_SESSION["user"]->email) && !empty($_SESSION["user"]->email) ? ' value="' . $_SESSION["user"]->email . '"' : ' autofocus' ?> />
                    </div>
                    <div class="col2">
                        <label for="birthday">Születési év</label>
                        <input type="date" name="birthday" id="birthday"
                            <?= isset($_SESSION["user"]->birthday) && !empty($_SESSION["user"]->birthday) ? ' value="' . $_SESSION["user"]->birthday . '"' : '' ?> />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col1">
                    <button class="tr-all">Adataim mentése</button>
                </div>
            </div>
            <?php include_once("error.php") ?>
            <?php if(isset($_GET["success"])): ?>
            <div class="row">
                <div class="col1">
                    <div class="success">Az adatok módosítása sikeres.</div>
                </div>
            </div>
            <?php endif ?>
        </form>
    </div>
</section>