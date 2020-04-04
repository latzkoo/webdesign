<?php

class JSON extends File
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $filename
     * @param $data
     */
    public function write($filename, $data)
    {
        if (empty($data))
            $data = [];

        parent::write($filename, json_encode($data));
    }

    /**
     * @param $filename
     * @return false|mixed|string
     */
    public function read($filename)
    {
        return json_decode(parent::read($filename));
    }

}