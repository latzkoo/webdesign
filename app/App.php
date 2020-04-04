<?php

class App
{
    public static $cookiesEnabled = true;

    public static function boot()
    {
        setcookie("check", true);

        if (!isset($_COOKIE["check"])) {
            ini_set("session.use_cookies", 0);
            ini_set("session.use_only_cookies",0);
            ini_set("session.use_trans_sid", true);

            self::$cookiesEnabled = false;
        }
    }

    /**
     * @param $data
     */
    public static function run($data)
    {
        extract($data);

        include_once(dirname(__DIR__)."/views/index.php");

        $app = ob_get_contents();
        ob_end_clean();

        echo $app;
    }

    /**
     * @return bool
     */
    public static function isCookiesEnabled()
    {
        return self::$cookiesEnabled;
    }

}