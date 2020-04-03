<aside>
    <div class="box bg-gray">
        <div class="aside-title"><h2>Kategóriák</h2></div>
        <div class="categories"><ul>
            <?php foreach($categories as $category): ?>
            <li><a class="tr-color" href="/fa4zpw/?page=hirdetesek&category=<?=$category["url"]?>"><?=$category["name"]?> (<?=$category["items"]?>)</a></li>
            <?php endforeach; ?>
        </ul></div>
    </div>
</aside>