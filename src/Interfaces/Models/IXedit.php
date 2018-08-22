<?php

namespace Xedit\Base\Interfaces\Models;

use Xedit\Base\Core\IBase;

interface IXedit extends IBase
{

    /** Methods */
    public static function get($condition): IXedit;

    /** Relations */
    public function getContainer(): IXeditContainer;

}
