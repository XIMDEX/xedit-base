<?php

namespace Xedit\Base\Interfaces\Models;


interface IXeditContainer
{

    /** Attributes */
    public function getId();

    public function getTitle(): string;

    public function getContent(): string;

    /** Methods */
    public static function get($attribute, $value);

    public function saveContent($content): bool;

    /** Relations */
    public function getLayout(): IXeditLayout;

}
