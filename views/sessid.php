<?php if(!App::isCookiesEnabled()): ?>
    <input type="hidden" name="PHPSESSID" value="<?=session_id()?>" />
<?php endif ?>