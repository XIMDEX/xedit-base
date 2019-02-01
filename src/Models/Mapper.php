<?php

namespace Xedit\Base\Models;

class Mapper
{
    private $doc;
    private $router;
    private $data;
    private $mediaManager;

    public function __construct(DocumentMapper $doc, RouterMapper $router, $data = null, string $mediaManager = 'tree')
    {
        if (is_null($router)) {
            throw new \InvalidArgumentException('Router mapper can not be null');
        }

        $this->doc = $doc;
        $this->router = $router;
        $this->data = $data;
        $this->mediaManager = $mediaManager;
    }

    /******** Getters and setters ********/
    public function getRouter(): RouterMapper
    {
        return $this->router;
    }

    public function getDocument()
    {
        return $this->doc;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMediaManager()
    {
        return $this->mediaManager;
    }

    /******** Methods ********/
    public function toArray()
    {
        return [
            "dam" => $this->getMediaManager(),
            "document" => $this->getDocument()->toArray(),
            "router" => $this->getRouter()->toArray(),
            "data" => !is_null($this->getData()) ? $this->getData() : ''
        ];
    }

    public function __toString()
    {
        return 'window.$xedit = ' . json_encode($this->toArray());
    }
}
