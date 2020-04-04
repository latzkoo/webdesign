<?php

class Page
{
    private $name;
    private $url;
    private $protected;

    /**
     * Page constructor.
     * @param $name
     * @param $url
     * @param bool $protected
     */
    public function __construct($name, $url, $protected = false)
    {
        $this->name = $name;
        $this->url = $url;
        $this->protected = $protected;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isProtected()
    {
        return $this->protected;
    }

    /**
     * @param bool $protected
     */
    public function setProtected($protected)
    {
        $this->protected = $protected;
    }

}