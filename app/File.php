<?php

namespace app;

use \Exception;

class File
{
    private $dir;

    public function __construct()
    {
        $this->dir = dirname(__DIR__) . "/assets/storage";
    }

    /**
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }

    /**
     * @param string $dir
     */
    public function setDir($dir)
    {
        $this->dir = $dir;
    }

    /**
     * @param $filename
     * @param $data
     */
    public function write($filename, $data)
    {
        try {
            $file = @fopen($this->dir . "/" . $filename, "w");

            if (!$file)
                throw new Exception("Hiba! Nem lehet megnyitni a fájlt: " . $filename);

            fwrite($file, $data);
            fclose($file);
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $filename
     * @return false|string
     */
    public function read($filename)
    {
        try {
            $data = "";

            $file = $this->dir . "/" . $filename;
            $resource = @fopen($file, "r");

            if (!$resource)
                throw new Exception("Hiba! Nem lehet megnyitni a fájlt: " . $filename);

            if ($size = filesize($file))
                $data = fread($resource, $size);

            fclose($resource);

            return $data;
        }
        catch (Exception $e) {
            die($e->getMessage());
        }
    }

}