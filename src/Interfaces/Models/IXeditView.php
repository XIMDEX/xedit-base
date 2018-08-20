<?php

namespace Xedit\Base\Interfaces\Models;

interface IXeditView
{
    /** Attributes */
    public function getContent(): string;

    /** Methods */
    public static function get($attribute, $value);
}
