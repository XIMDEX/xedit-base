<?php

namespace Xedit\Base\Interfaces\Models;


interface IXedit
{

    /** Methods */
    public static function get($attribute, $value);

    /** Relations */
    public function getContainer(): IXeditContainer;

}
