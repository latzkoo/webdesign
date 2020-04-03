<div class="registration">
    <h1>Hirdetésfeladás</h1>
    <?php if (isset($_GET["success"])): ?>
        <article>
            <p>A hirdetésfeladás sikeres!</p>
            <p>Böngésszen a <a href="/fa4zpw/?page=hirdetesek">feladott hirdetések</a> között, vagy adjon hozzá még egyet!</p>
            <a href="/fa4zpw/?page=hirdetesfeladas">
                <button class="login tr-all">Új hirdetés feladása</button>
            </a>
        </article>
    <?php else: ?>
        <div class="formblock">
            <form action="/fa4zpw/?page=hirdetesfeladas" method="post" enctype="multipart/form-data">
                <fieldset>
                    <legend>A hirdetés adatai</legend>
                    <div class="row">
                        <div class="col1">
                            <label for="title">A hirdetés címe<span class="required">*</span></label>
                            <input type="text" name="title" id="title" maxlength="100" required="required" placeholder="A termék megnevezése"
                                <?=isset($_POST["title"]) && !empty($_POST["title"]) ? ' value="' . $_POST["title"] . '"' : ' autofocus' ?> />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2">
                            <label for="category">Kategória<span class="required">*</span></label>
                            <select name="category" id="category" required="required">
                                <option value="" disabled="disabled" selected="selected">Válasszon!</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?=$category["url"]?>"
                                        <?=isset($_POST["category"]) && $_POST["category"] == $category["url"] ? ' selected="selected"' : '' ?>><?= $category["name"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col2">
                            <div class="label">Állapot<span class="required">*</span></div>
                            <div class="checkboxes">
                                <label for="status1">Új</label>
                                <input type="radio" name="status" id="status1" value="1" required="required"
                                    <?=isset($_POST["status"]) && $_POST["status"] == 1 ? ' checked="checked"' : '' ?> />
                                <label for="status2">Használt</label>
                                <input type="radio" name="status" id="status2" value="2"
                                    <?=isset($_POST["status"]) && $_POST["status"] == 2 ? ' checked="checked"' : '' ?> />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2">
                            <label for="city">Település<span class="required">*</span></label>
                            <input type="text" name="city" id="city" maxlength="50" required="required"
                                <?= isset($_POST["city"]) && !empty($_POST["city"]) ? ' value="' . $_POST["city"] . '"' : '' ?> />
                        </div>
                        <div class="col2">
                            <label for="price">Ár<span class="required">*</span></label>
                            <input type="number" name="price" id="price" min="0" max="99999999" required="required"
                                <?= isset($_POST["price"]) && !empty($_POST["price"]) ? ' value="' . $_POST["price"] . '"' : '' ?> />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col2">
                            <div class="label">Átvédel módja<span class="required">*</span></div>
                            <div class="checkboxes">
                                <label for="delivery1">Személyesen</label>
                                <input type="checkbox" name="delivery[]" id="delivery1" value="1"
                                    <?=isset($_POST["delivery"]) && in_array(1, $_POST["delivery"]) ? ' checked="checked"' : '' ?> />
                                <label for="delivery2">Postai utánvét</label>
                                <input type="checkbox" name="delivery[]" id="delivery2" value="2"
                                    <?=isset($_POST["delivery"]) && in_array(2, $_POST["delivery"]) ? ' checked="checked"' : '' ?> />
                            </div>
                        </div>
                        <div class="col2">
                            <label for="image">Kép feltöltése (max. 1 MB)</label>
                            <input type="file" name="image" id="image" accept=".jpg, .jpeg" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col1">
                            <label for="description">Rövid leírás<span class="required">*</span></label>
                            <textarea name="description" id="description" minlength="20" maxlength="500" required="required" placeholder="Írjon néhány mondatot a termékről"><?=isset($_POST["description"]) && !empty($_POST["description"]) ? $_POST["description"] : ''?></textarea>
                        </div>
                    </div>
                </fieldset>
                <div class="row">
                    <div class="col1">
                        <button class="tr-all">Hozzáadás</button>
                    </div>
                </div>
                <?php include_once("error.php") ?>
            </form>
        </div>
    <?php endif ?>
</div>