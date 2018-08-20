<?php

namespace Xedit\Base\Interfaces\Models;

interface IXeditComponent
{

    /** Attributes */
    public function getContent(): string;

    /** Methods */
    public static function get($attribute, $value);

    /** Relations */
    public function getView(): IXeditView;
}
