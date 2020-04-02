<?php


namespace app;


class App
{

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

}