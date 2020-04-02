<header>
    <div class="top">
        <div class="container">
            <div class="left">
                <nav>
                    <a class="tr-all<?=isset($_GET["page"]) && $_GET["page"] == "gyik" ? " selected" : ""?>" href="/fa4zpw/?page=gyik">GY.I.K.</a>
                </nav>
            </div>
            <div class="right">
                <nav>
                    <?php if(isset($_SESSION["email"]) && isset($_SESSION["firstname"])): ?>
                        <span class="user tr-all"><?=$_SESSION["firstname"]?></span>
                        <a class="tr-all" href="/fa4zpw/?page=adatmodositas">Profilom</a>
                        <a class="tr-all" href="/fa4zpw/?logout">Kilépés</a>
                    <?php else: ?>
                        <a class="tr-all<?=isset($_GET["page"]) && $_GET["page"] == "regisztracio" ? " selected" : ""?>" href="/fa4zpw/?page=regisztracio">Regisztráció</a>
                        <a class="tr-all<?=isset($_GET["page"]) && $_GET["page"] == "belepes" ? " selected" : ""?>" href="/fa4zpw/?page=belepes">Belépés</a>
                    <?php endif ?>
                </nav>
            </div>
        </div>
    </div>
    <div class="middle">
        <div class="container">
            <div class="logo"><a href="/fa4zpw/" title="Apróhirdetés"></a></div>
            <div class="new-ad"><a class="tr-all" href="/fa4zpw/?page=hirdetesfeladas"><span>Hirdetésfeladás</span></a></div>
            <button class="mobilemenu" id="mobilemenu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
    <div class="bottom">
        <div class="container">
            <nav class="main-menu" id="mainmenu"><ul>
                <li><a class="tr-color" href="/fa4zpw/">Főoldal<span class="line"></span></a></li>
                <li><a class="tr-color<?=isset($_GET["page"]) && $_GET["page"] == "hirdetesek" ? " selected" : ""?>" href="/fa4zpw/?page=hirdetesek">Hirdetések<span class="line"></span></a></li>
                <li><a class="tr-color<?=isset($_GET["page"]) && $_GET["page"] == "kapcsolat" ? " selected" : ""?>" href="/fa4zpw/?page=kapcsolat">Kapcsolat<span class="line"></span></a></li>
            </ul></nav>
        </div>
    </div>
</header>