<?php

namespace Xedit\Base\Interfaces\Models;

use Xedit\Base\Core\IBase;

interface IXedit extends IBase
{

    /** Relations */
    public function getContainer(): IXeditContainer;

}
