<?php

class File
{
    private $storageDir;
    private $imageDir;
    private $acceptedExtensions;

    public function __construct()
    {
        $this->setStorageDir(dirname(__DIR__) . "/assets/storage");
        $this->setImageDir(dirname(__DIR__) . "/assets/images");
        $this->setAcceptedExtensions(["jpg", "jpeg"]);
    }

    /**
     * @return mixed
     */
    public function getAcceptedExtensions()
    {
        return $this->acceptedExtensions;
    }

    /**
     * @param mixed $acceptedExtensions
     */
    public function setAcceptedExtensions($acceptedExtensions)
    {
        $this->acceptedExtensions = $acceptedExtensions;
    }

    /**
     * @return mixed
     */
    public function getImageDir()
    {
        return $this->imageDir;
    }

    /**
     * @param mixed $imageDir
     */
    public function setImageDir($imageDir)
    {
        $this->imageDir = $imageDir;
    }

    /**
     * @return string
     */
    public function getStorageDir()
    {
        return $this->storageDir;
    }

    /**
     * @param string $storageDir
     */
    public function setStorageDir($storageDir)
    {
        $this->storageDir = $storageDir;
    }

    /**
     * @param $filename
     * @param $data
     */
    public function write($filename, $data)
    {
        try {
            $file = @fopen($this->storageDir . "/" . $filename, "w");

            if (!$file)
                throw new Exception("Hiba! Nem lehet megnyitni a fájlt: " . $filename);

            fwrite($file, $data);
            fclose($file);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    /**
     * @param $filename
     * @return false|string
     */
    public function read($filename)
    {
        $data = "";

        $file = $this->storageDir . "/" . $filename;
        $resource = @fopen($file, "r");

        if (!$resource)
            $resource = fopen($file, "w");

        if ($size = filesize($file))
            $data = fread($resource, $size);

        fclose($resource);

        return $data;
    }

    public function upload($file)
    {
        if (empty($file["name"]) && !$file["size"])
            return null;

        $extension = pathinfo(basename($file["name"]), PATHINFO_EXTENSION);
        $filename = time() . "_" . rand(0, 1000) . "." . $extension;
        $filePath = $this->imageDir . "/" . $filename;

        if (!in_array($extension, $this->acceptedExtensions))
            $image["error"]["message"] = "Csak .jpg kiterjesztésű fájl tölthető fel!";

        else if($file["size"] > 1048576)
            $image["error"]["message"] = "A fájl mérete túl nagy! (Max 1 MB)";

        else {
            if (move_uploaded_file($file["tmp_name"], $filePath))
                $image["filename"] = $filename;
            else
                $image["filename"] = "";
        }

        return $image;
    }

}