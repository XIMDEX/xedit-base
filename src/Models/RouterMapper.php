<?php

namespace Xedit\Base\Models;

use \InvalidArgumentException;

class RouterMapper
{

    private $baseUrl;
    private $action = '_action';
    private $saveUrl = '/save/:id';
    private $infoNodeUrl = '/save/:id';
    private $resourceUrl = '/resource/:id';

    public function __construct($baseUrl)
    {
        if (is_null($baseUrl))
            throw new InvalidArgumentException('Invalid base url');

        $this->baseUrl;
    }

    /** Getters and setters */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function setAction(string $action): string
    {
        $this->action = $action;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function setSaveUrl(string $url)
    {
        $this->saveUrl = $url;
    }

    public function getSaveUrl(): string
    {
        return $this->saveUrl;
    }

    public function setInfoNodeUrl(string $url)
    {
        $this->infoNodeUrl = $url;
    }

    public function getInfoNodeUrl(): string
    {
        return $this->infoNodeUrl;
    }

    public function setResourceUrl(string $url)
    {
        $this->resourceUrl = $url;
    }

    public function getResourceUrl(): string
    {
        return $this->resourceUrl;
    }


    /** Methods **/
    public function toArray()
    {
        return [
            'baseUrl' => $this->getBaseUrl(),
            'action' => $this->getAction(),
            'routes' => [
                'set' => $this->getSaveUrl(),
                'infoNode' => $this->getInfoNodeUrl(),
                'resource' => $this->getResourceUrl()
            ]
        ];
    }
}
