<?php

namespace Xedit\Base\Interfaces\Models;

use Xedit\Base\Core\IBase;

interface IXeditView extends IBase
{
    /** Attributes */
    public function getContent(): string;
}
