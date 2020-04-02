<?php

namespace app;

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
        self::$pages[] = new Page("Adataim módosítása", "adatmodositas", true);
        self::$pages[] = new Page("Kapcsolat", "kapcsolat");
        self::$pages[] = new Page("Impresszum", "impresszum");
    }

    public static function getPage()
    {
        if (isset($_GET["page"]) && !empty($_GET["page"])) {
            if ($page = self::isPage($_GET["page"])) {
                if (!$page->isProtected())
                    return $_GET["page"];

                if (isset($_SESSION["email"]))
                    return $_GET["page"];
                else
                    return header("Location: /fa4zpw/?page=belepes&redirect_to={$_GET["page"]}");
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

    public static function router()
    {
        global $data;

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

        $data["page"] = self::getPage();
    }

}