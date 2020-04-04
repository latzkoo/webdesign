<div class="formblock">
    <form action="/fa4zpw/?page=<?=$_GET["page"]?><?=isset($_GET["edit"]) ? "&edit=" . $_GET["edit"] : '' ?>"
          method="post" enctype="multipart/form-data">
        <?php include("views/sessid.php")?>
        <?php if(isset($_GET["edit"]) && !empty($_GET["edit"])): ?>
            <input type="hidden" name="id" value="<?=$_GET["edit"]?>" />
        <?php endif ?>
        <fieldset>
            <legend>A hirdetés adatai</legend>
            <div class="row">
                <div class="col1">
                    <label for="title">A hirdetés címe<span class="required">*</span></label>
                    <input type="text" name="title" id="title" maxlength="100" required="required" placeholder="A termék megnevezése"
                        <?=isset($ad["title"]) && !empty($ad["title"]) ? ' value="' . $ad["title"] . '"' : ' autofocus' ?> />
                </div>
            </div>
            <div class="row">
                <div class="col2">
                    <label for="category">Kategória<span class="required">*</span></label>
                    <select name="category" id="category" required="required">
                        <option value="" disabled="disabled"<?=!isset($ad["category"]) ? ' selected="selected"' : '' ?>>Válasszon!</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?=$category["url"]?>"
                                <?=isset($ad["category"]) && $ad["category"] == $category["url"] ? ' selected="selected"' : '' ?>><?= $category["name"] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col2">
                    <div class="label">Állapot<span class="required">*</span></div>
                    <div class="checkboxes">
                        <label for="status1">Új</label>
                        <input type="radio" name="status" id="status1" value="1" required="required"
                            <?=isset($ad["status"]) && $ad["status"] == 1 ? ' checked="checked"' : '' ?> />
                        <label for="status2">Használt</label>
                        <input type="radio" name="status" id="status2" value="2"
                            <?=isset($ad["status"]) && $ad["status"] == 2 ? ' checked="checked"' : '' ?> />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col2">
                    <label for="city">Település<span class="required">*</span></label>
                    <input type="text" name="city" id="city" maxlength="50" required="required"
                        <?= isset($ad["city"]) && !empty($ad["city"]) ? ' value="' . $ad["city"] . '"' : '' ?> />
                </div>
                <div class="col2">
                    <label for="price">Ár<span class="required">*</span></label>
                    <input type="number" name="price" id="price" min="0" max="99999999" required="required"
                        <?= isset($ad["price"]) && !empty($ad["price"]) ? ' value="' . $ad["price"] . '"' : '' ?> />
                </div>
            </div>
            <div class="row">
                <div class="col2">
                    <div class="label">Átvédel módja<span class="required">*</span></div>
                    <div class="checkboxes">
                        <label for="delivery1">Személyesen</label>
                        <input type="checkbox" name="delivery[]" id="delivery1" value="1"
                            <?=isset($ad["delivery"]) && in_array(1, $ad["delivery"]) ? ' checked="checked"' : '' ?> />
                        <label for="delivery2">Postai utánvét</label>
                        <input type="checkbox" name="delivery[]" id="delivery2" value="2"
                            <?=isset($ad["delivery"]) && in_array(2, $ad["delivery"]) ? ' checked="checked"' : '' ?> />
                    </div>
                </div>
                <div class="col2">
                    <label for="image">Kép <?=isset($_GET["edit"]) && !empty($_GET["edit"]) ? 'cseréje' : 'feltöltése'?> (max. 1 MB)</label>
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg" />
                </div>
            </div>
            <div class="row">
                <div class="col1">
                    <label for="description">Rövid leírás<span class="required">*</span></label>
                    <textarea name="description" id="description" minlength="20" maxlength="500" required="required" placeholder="Írjon néhány mondatot a termékről"><?=isset($ad["description"]) && !empty($ad["description"]) ? $ad["description"] : ''?></textarea>
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col1">
                <button class="tr-all"><?=isset($edit) ? "Módosítás" : "Hozzáadás"?></button>
            </div>
        </div>
        <?php include_once("error.php") ?>
    </form>
</div>