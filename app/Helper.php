<?php

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

    /**
     * @param $price
     * @return string
     */
    public static function formatPrice($price)
    {
        if ($price != 0)
            $price = number_format($price, 0, '.', ' ');

        return $price;
    }

    public static function formatTime($time)
    {
        return date("Y.m.d H:i", $time);
    }

    /**
     * @param $url
     * @return string
     */
    public static function buildURL($url)
    {
        if (!App::isCookiesEnabled())
            $url .= (strpos($url, '?') !== false ? "&" : "?") . SID;

        return $url;
    }

    public static function removePHPSESSID($referer)
    {
        if ($pos = strpos($referer,"PHPSESSID")) {
            $referer = substr($referer, 0, $pos);

            if (in_array(substr($referer, -1), ["?", "&"]))
                $referer = substr($referer, 0, strlen($referer) - 1);
        }

        return $referer;
    }

}