<?php


namespace app;


class Helper
{
    public static function getPageURLFromReferer($referer)
    {
        if ($get = self::getParamsFromUriString($referer))
            return $get["page"];

        return null;
    }

    /**
     * @param $referer
     * @return array
     */
    public static function getParamsFromUriString($referer)
    {
        $pos = strpos($referer, "?");
        if (!$pos)
            return false;

        $queryString = substr($referer, $pos + 1, strlen($referer) - $pos);
        $queryStringArr = explode("&", $queryString);

        $get = [];
        foreach ($queryStringArr as $item) {
            $el = explode("=", $item);
            $get[$el[0]] = isset($el[1]) ? $el[1] : null;
        }

        return $get;
    }
}