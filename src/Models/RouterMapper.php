<?php

namespace Xedit\Base\Models;

class RouterMapper
{

    private $baseUrl;
    private $endpoints;
    private $token;
    private $attrs;


    public function __construct(string $baseUrl, array $token, $endpoints = null, $attrs = [])
    {
        $this->baseUrl = $baseUrl;
        $this->token = $token;
        $this->endpoints = !is_null($endpoints) ? $endpoints : $this->configEndpoints();
        $this->attrs = $attrs;

    }

    /** Getters and setters */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    public function getEndpoints()
    {
        return $this->endpoints;
    }

    public function setParamEndpoint(string $endpoint, string $name, $params)
    {
        $this->endpoints[$endpoint][$name]['params'] = $params;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getAttrs()
    {
        return $this->attrs;
    }

    public function addAttr($attr, $value)
    {
        $this->attrs[$attr] = $value;
    }

    public function existAttr(string $attr)
    {
        return is_array($this->attrs) && isset($this->attrs[$attr]);
    }

    /** Methods **/
    private function configEndpoints()
    {
        return [
            'documents' => [
                'get' => [
                    'method' => 'get',
                    'path' => 'xedit/{id}'
                ],
                'save' => [
                    'method' => 'post',
                    'path' => 'xedit/{id}'
                ]
            ],
            'resources' => [
                'tree' => [
                    'method' => 'get',
                    'path' => 'xedit/resources/tree',
                ],
                'image' => [
                    'method' => 'get',
                    'path' => 'resources/{id}/image',
                ],
                'get' => [
                    'method' => 'get',
                    'path' => 'xedit/resources/{id}'
                ]
            ]
        ];
    }

    public function toArray()
    {
        return [
            'baseUrl' => $this->getBaseUrl(),
            'token' => $this->getToken(),
            'endpoints' => $this->getEndpoints(),
            'attrs' => $this->getAttrs()
        ];
    }
}
