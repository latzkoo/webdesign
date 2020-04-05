<div class="classifieds">
    <div class="items">
        <?php if(isset($ads) && count($ads) > 0):?>
            <?php foreach (array_reverse($ads) as $ad): ?>
                <div class="item">
                    <?php if(isset($edit) && $edit):?>
                    <div class="edit-ad" title="Szerkesztés">
                        <a href="<?=Helper::buildURL("/fa4zpw/?page=hirdeteseim&edit=".$ad->id)?>"></a>
                    </div>
                    <div class="delete-ad" title="Törlés">
                        <a class="delete" href="<?=Helper::buildURL("/fa4zpw/?page=hirdeteseim&delete=".$ad->id)?>"></a>
                    </div>
                    <?php endif ?>
                    <div class="image<?=empty($ad->image) ? ' default' : ''?>">
                        <?php if(!empty($ad->image)): ?>
                        <img src="/fa4zpw/assets/images/<?=$ad->image?>" alt="<?=$ad->title?>" />
                        <?php endif ?>
                    </div>
                    <div class="details">
                        <div class="title"><?=$ad->title?></div>
                        <div class="info"><a href="mailto:<?=$ad->user->email?>"><?=$ad->user->email?></a> | <?=$ad->city?> | <?=\Helper::formatTime($ad->created_at)?></div>
                        <div class="category"><?=$ad->category["name"]?></div>
                        <div class="status">
                            <span class="strong">Állapot</span>:
                            <span class="highlighted"><?=$ad->status == 1 ? "új" : "használt" ?></span>
                        </div>
                        <div class="delivery">
                            <span class="strong">Átvétel módja</span>:
                            <?=in_array(1, $ad->delivery) ? "személyesen" : ''?>
                            <?=in_array(2, $ad->delivery) ? (count($ad->delivery) > 1 ? ", " : '')."futárszolgálat" : ''?>
                        </div>
                        <div class="price"><?=\Helper::formatPrice($ad->price)?> Ft</div>
                        <div class="description"><?=$ad->description?></div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else: ?>
            <div class="noitem">Nem található hirdetés.</div>
        <?php endif ?>
    </div>
</div>