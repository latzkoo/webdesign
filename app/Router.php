<?php

class Router
{
    public static $pages;

    public static function init()
    {
        self::$pages[] = new Page("Hirdetések", "hirdetesek");
        self::$pages[] = new Page("Hirdetésfeladás", "hirdetesfeladas", true);
        self::$pages[] = new Page("Gyakran ismételt kérdések", "gyik");
        self::$pages[] = new Page("Regisztráció", "regisztracio");
        self::$pages[] = new Page("Belépés", "belepes");
        self::$pages[] = new Page("Profilom", "profilom", true);
        self::$pages[] = new Page("Hirdetéseim", "hirdeteseim", true);
        self::$pages[] = new Page("Kapcsolat", "kapcsolat");
        self::$pages[] = new Page("Impresszum", "impresszum");
    }

    public static function getPage()
    {
        if (isset($_GET["page"]) && !empty($_GET["page"])) {
            if ($page = self::isPage($_GET["page"])) {
                if (!$page->isProtected())
                    return $_GET["page"];

                if (isset($_SESSION["user"]))
                    return $_GET["page"];
                else
                    header("Location: /fa4zpw/?page=belepes&redirect_to={$_GET["page"]}");
            }
            else
                return "404";
        }
        else
            return "main";
    }

    /**
     * @param $url
     * @return bool
     */
    private static function isPage($url)
    {
        foreach (self::$pages as $page) {
            if ($page->getUrl() == $url)
                return $page;
        }

        return false;
    }

    public static function route()
    {
        global $data;

        $ads = new Ads();
        $data["categories"] = $ads->getCategories(true);
        $data["page"] = self::getPage();

        /**
         * Logout
         */
        if (isset($_GET["logout"])) {
            $auth = new Auth();
            $auth->logout();
        }
        /**
         * Login
         */
        else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["page"]) && $_GET["page"] == "belepes") {
            $auth = new Auth();
            $auth->login();
        }
        /**
         * Registration
         */
        else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["page"]) && $_GET["page"] == "regisztracio") {
            $auth = new Auth();
            $auth->register($_POST);
        }
        /**
         * Profile
         */
        else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["page"]) && $_GET["page"] == "profilom") {
            $auth = new Auth();
            $auth->update($_POST);
        }
        /**
         * Ad POST
         */
        else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["page"]) && $_GET["page"] == "hirdetesfeladas") {
            if (!isset($_SESSION["user"]))
                header("Location: /fa4zpw/?page=belepes&redirect_to={$_GET["page"]}");

            $ads->add($_POST, $_FILES);
            $data["ad"] = $_POST;
        }
        /**
         * Ad GET
         */
        else if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["page"]) && $_GET["page"] == "hirdetesek") {
            if (isset($_GET["category"]) && !empty($_GET["category"]))
                $data["category"] = $ads->getCategory($_GET["category"]);

            $data["ads"] = $ads->getAds(null, isset($_GET["category"]) && !empty($_GET["category"]) ? $_GET["category"] : null);
        }
        /**
         * My ads GET
         */
        else if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET["page"]) && $_GET["page"] == "hirdeteseim") {
            if (isset($_GET["delete"]) && !empty($_GET["delete"]))
                $ads->deleteAd($_GET["delete"]);

            else if (isset($_GET["edit"]) && !empty($_GET["edit"])) {
                $data["ad"] = (array)$ads->getAd($_GET["edit"]);

                if ($_SESSION["user"]->id != $data["ad"]["user_id"])
                    $data["notfound"] = true;
            }

            else
                $data["ads"] = $ads->getAds(null, null, $_SESSION["user"]->id);

            $data["edit"] = true;
        }

        /**
         * Edit ad POST
         */
        else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_GET["page"]) && $_GET["page"] == "hirdeteseim") {
            $ads->update($_POST, $_FILES);
            $data["ad"] = $_POST;
        }

        else {
            $data["ads"] = $ads->getAds(5);
        }
    }

}