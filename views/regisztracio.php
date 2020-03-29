<section class="registration">
    <h1>Regisztráció</h1>
    <div class="formblock">
        <form action="/fa4zpw/?page=registration" method="post">
            <fieldset>
                <legend>Regisztrációs adatok</legend>
                <div class="row">
                    <div class="col2">
                        <label for="lastname">Vezetéknév</label>
                        <input type="text" name="lastname" id="lastname" value="" required="required" maxlength="50"/>
                    </div>
                    <div class="col2">
                        <label for="firstname">Keresztnév</label>
                        <input type="text" name="firstname" id="firstname" value="" required="required" maxlength="50"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col2">
                        <label for="email">E-mail cím</label>
                        <input type="email" name="email" id="email" value="" required="required" maxlength="100"/>
                    </div>
                    <div class="col2">
                        <label for="birthday">Születési év</label>
                        <input type="date" name="birthday" id="birthday" value=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col2">
                        <label for="passwd">Jelszó</label>
                        <input type="password" name="passwd" id="passwd" value="" required="required" minlength="6"
                               maxlength="20" autocomplete="new-password" />
                    </div>
                    <div class="col2">
                        <label for="repasswd">Jelszó megerősítése</label>
                        <input type="password" name="repasswd" id="repasswd" value="" required="required" minlength="6"
                               maxlength="20" autocomplete="new-password" />
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col1">
                    <button class="tr-all">Regisztráció</button>
                </div>
            </div>
        </form>
    </div>
</section>