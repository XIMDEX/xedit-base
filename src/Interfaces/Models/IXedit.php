<?php

namespace Xedit\Base\Interfaces\Models;

interface IXedit
{

    /** Attributes */
    public function getId();

    /** Methods */
    public static function get($attribute, $value): IXedit;

    /** Relations */
    public function getContainer(): IXeditContainer;

}
