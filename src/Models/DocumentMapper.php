<?php

namespace Xedit\Base\Models;

class DocumentMapper
{

    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    /******** Getters and setters ********/
    public function getId(): string
    {
        return $this->id;
    }

    /******** Methods ********/
    public function toArray()
    {
        return [
            "id" => $this->id
        ];
    }

    public function __toString()
    {
        return json_encode($this->toArray());
    }
}